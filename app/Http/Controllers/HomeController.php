<?php

namespace App\Http\Controllers;
use App\Allocation;
use App\DamageApplication;
use App\Depot;
use App\DepotUser;
use App\DfProblem;
use App\DfReturn;
use App\Item;
use App\Requisition;
use App\Role;
use App\Shop;
use App\Stock;
use App\StockTransfer;
use App\Traits\HasStageExists;
use App\Zone;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller {
	use HasStageExists;
	private $canApply = false;
	private $user = null;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->middleware(function ($request, $next) {
			if ($request->user()) {
				$this->user = $request->user();
				$this->canApply = (bool) Role::where('id', $this->user->role_id)->value('can_apply');
			}
			return $next($request);
		});
		//$this->middleware('auth');
	}

	private function getDFStatus() {
		$rawDataArr = [
			'purchased' => 0,
			'injected' => 0,
			'stock' => 0,
			'in_sip' => 0,
			'damage' => 0,
			'support' => 0,
			'low_cooling' => 0,
			'initial_damage' => 0,
		];

		if (!$this->canApply) {
			$itemObj = Item::join('depot_users', 'depot_users.depot_id', '=', 'items.depot_id')
				->leftJoin('shops', function ($join) {
					$join->on('shops.id', '=', 'items.shop_id');
					$join->whereNotNull('items.item_status');
				})
				->where('depot_users.user_id', $this->user->id);
		} else {
			$itemObj = Item::join('shops', function ($join) {
				$join->on('shops.id', '=', 'items.shop_id');
				$join->whereNotNull('items.item_status');
			})
				->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
				->where('distributor_users.user_id', $this->user->id);
		}

		// $itemObj = Item::join('shops', 'shops.id', '=', 'items.shop_id')
		// 	->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
		// 	->join('shops as distributor', 'distributor.id', '=', 'shops.distributor_id')
		// 	->where('distributor_users.user_id', auth()->user()->id);

		$itemObj2 = clone $itemObj;
		$itemObj3 = clone $itemObj;

		//Injected DF
		$injected = $itemObj->whereIn('items.freeze_status', ['used', 'low_cooling', 'damage_applied'])
			->whereNotNull('item_status')
			->count();

		// For Damage, Support, Low cooling
		$items = $itemObj2->select('items.freeze_status', DB::raw('count(*) as total'))
			->whereIn('items.freeze_status', ['damage', 'support', 'low_cooling'])
			->groupBy('items.freeze_status')
			->pluck('total', 'items.freeze_status');

		if (!$this->canApply) {
			//damage when receive in depot
			$initialDamage = Item::whereNull('shop_id')
				->where('freeze_status', 'damage')
				->join('depot_users', 'depot_users.depot_id', '=', 'items.depot_id')
				->where('depot_users.user_id', $this->user->id)
				->count();
		} else {
			$initialDamage = 0;
		}

		//In sip DF
		$in_sip = $itemObj3->where('items.item_status', 'in_sip')
			->count();

		// For Stock In hand and
		$stock = Item::join('depot_users', 'depot_users.depot_id', '=', 'items.depot_id')
			->where('depot_users.user_id', $this->user->id)
			->where(function ($query) {
				$query->where('items.item_status', 'locked')
					->orWhereNull('items.item_status');
			})
			->whereIn('items.freeze_status', ['used', 'fresh', 'low_cooling'])
			->count();
		$items->put('stock', $stock);

		//$items = $items->merge($itms2);
		$items->put('in_sip', $in_sip);
		$items->put('injected', $injected);
		$items->put('initial_damage', $initialDamage);

		// if (isMenuRender('InventoriesControler@stockIndex', $this->menu_list)) {

		// }

		if (isMenuRender('SuppliersController@index', $this->menu_list)) {
			// For total Purched DF
			$purchased = Stock::sum('total_item');
			$items->put('purchased', $purchased);
		}

		$resultDataArr = $items->toArray();
		return array_merge($rawDataArr, $resultDataArr);
	}

	//depot wise DF status
	private function depotWiseDfStatus() {

		if (DepotUser::where('user_id', $this->user->id)->count() > 2) {
			$itemObj = Item::join('depot_users', 'depot_users.depot_id', '=', 'items.depot_id')
				->where('depot_users.user_id', $this->user->id);
			$itemObj2 = clone $itemObj;
			$itemObj3 = clone $itemObj;

			//low cooling and support
			$items = $itemObj2->select('items.freeze_status', 'items.depot_id', DB::raw('count(*) as total'))
				->whereIn('items.freeze_status', ['support', 'low_cooling'])
				->groupBy('items.freeze_status', 'items.depot_id');

			//stock (locked df by transfering to another depot , fresh df and fully returned df )
			$stocks = $itemObj->select(DB::raw('1 as freeze_status'), 'items.depot_id', DB::raw('count(*) as total'))
				->whereIn('items.freeze_status', ['fresh', 'used', 'low_cooling'])
				->where(function ($query) {
					$query->where('item_status', 'locked')
						->orWhereNull('item_status');
				})
				->groupBy('items.depot_id');

			//Injected DF
			$injected = $itemObj3->select(DB::raw('2 as freeze_status'), 'items.depot_id', DB::raw('count(*) as total'))
				->whereIn('items.freeze_status', ['used', 'low_cooling', 'damage_applied'])
				->whereNotNull('shop_id')
				->whereNotNull('item_status')
				->groupBy('items.depot_id');
			$dataObj = $items->union($stocks)->union($injected)->get();
			$dataArr = [];
			//dd($dataObj->toArray());
			$status = ['low_cooling' => 'low_cooling', 'support' => 'support', '1' => 'stock', '2' => 'injected'];
			foreach ($dataObj as $obj) {
				$dataArr[$obj->depot_id][$status[$obj->freeze_status]] = $obj->total;
			}
			return $dataArr;
		} else {
			return false;
		}
	}

	private function getOutletStatus() {
		$retailerObj = Shop::select('shops.id')
			->where('shops.is_distributor', false)
			->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
			->join('shops as distributor', 'distributor.id', '=', 'shops.distributor_id')
			->where('distributor_users.user_id', $this->user->id);

		$retailerObj2 = clone ($retailerObj);

		$injectedRetailersCount = $retailerObj->join('settlements', 'shops.id', '=', 'settlements.shop_id')
			->whereIn('settlements.status', ['continue', 'reserve'])
			->select('shops.id')
			->groupBy('shops.id')
			->getQuery()
			->getCountForPagination();

		$noInjectedRetailersCount = $retailerObj2->leftJoin('settlements', 'settlements.shop_id', '=', 'shops.id')
			->selectRaw('SUM(settlements.status in ("continue","reserve")) as countVal')
			->having('countVal', '<', 1)
			->orHavingRaw('countVal is null')
			->groupBy('shops.id')
		//->getQuery()
		//->getCountForPagination();
			->get()
			->count();

		$distributors = Shop::join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.id')
			->where('is_distributor', true)
			->where('distributor_users.user_id', $this->user->id)
			->count();

		return ['retailers' => $injectedRetailersCount, 'nonInjectedRetailers' => $noInjectedRetailersCount, 'distributors' => $distributors];
	}

	private function waitToReceive() {
		$primary = false;
		$transfer = false;

		if (isMenuRender('InventoriesControler@allocatedStockReceive', $this->menu_list)) {
			$primary = Allocation::join('depot_users', 'depot_users.depot_id', '=', 'allocations.depot_id')
				->join('stocks', 'stocks.id', '=', 'allocations.stock_id')
				->where('stocks.is_allocated', 2)
				->where('depot_users.user_id', $this->user->id)
				->where('allocations.status', '<>', 'receive')
				->count();
		}

		if (isMenuRender('InventoriesControler@stockTransferReceive', $this->menu_list)) {
			$transfer = StockTransfer::join('depot_users', 'depot_users.depot_id', '=', 'stock_transfers.to_depot')
				->where('stock_transfers.approved_by', '>', 0)
				->where('stock_transfers.status', 'approve')
				->where('depot_users.user_id', $this->user->id)
				->count();
		}
		return ['primary' => $primary, 'transfer' => $transfer];
	}

	private function getPayment() {

		$obj = Requisition::with(['shop' => function ($q) {
			return $q->select('id', 'outlet_name');
		}])
			->where(function ($query) {
				$query->where('payment_verified', '<>', 'yes')
					->orWhereNull('payment_verified');
			})
			->where('payment_modes', '<>', 'without_rent')
			->where('payment_confirm', true)
			->where('status', 'approved')
			->select('id', 'shop_id', 'payment_methods', 'receive_amount')
			->orderBy('updated_at', 'desc');

		$bkashObj = clone $obj;

		$payment = false;
		$bkash = false;

		if (isMenuRender('RequisitionsController@payment_verify', $this->menu_list)) {
			$payment = $obj->where('payment_methods', '<>', 'bkash')
				->get();
		}

		if (isMenuRender('RequisitionsController@bkash_verify', $this->menu_list)) {
			$bkash = $bkashObj->where('payment_methods', 'bkash')
				->get();
		}

		return ['payment' => $payment, 'bkash' => $bkash];
	}

	private function getRequistionCount() {
		$requisitionObj = Requisition::join('distributor_users', 'distributor_users.distributor_id', '=', 'requisitions.distributor_id')
			->where('distributor_users.user_id', $this->user->id);
		if ($this->canApply) {
			$requisitions = $requisitionObj->select('requisitions.status', DB::raw('count(*) as total'))
				->where('requisitions.user_id', $this->user->id)
				->whereIn('requisitions.status', ['approved', 'on_hold', 'processing'])
				->whereRaw("IF(requisitions.status='processing',requisitions.action_by is not NULL,1)")
				->groupBy('requisitions.status')
				->pluck('total', 'requisitions.status');
			$objNew = clone $requisitionObj;
			$newCount = $objNew->where('requisitions.user_id', $this->user->id)
				->whereNull('requisitions.action_by')
				->where('requisitions.status', 'processing')
				->count();
			$requisitions->put('new', $newCount);
		} else {
			$sequence = $this->getStageSequence('requisition');
			if ($sequence) {
				$objNew = clone $requisitionObj;
				$requisitions = $requisitionObj->select('requisitions.status', DB::raw('count(*) as total'))
				//->whereNotNull('requisitions.action_by')
					->whereIn('requisitions.status', ['approved', 'on_hold', 'processing'])
					->whereRaw("IF(requisitions.status='processing',requisitions.stage != $sequence,1)")
					->groupBy('requisitions.status')
					->pluck('total', 'requisitions.status');
				$newCount = $objNew->where('stage', $sequence)->where('status', 'processing')->count();
				$requisitions->put('new', $newCount);
			} else {
				$requisitions = $requisitionObj->select('requisitions.status', DB::raw('count(*) as total'))
				//->whereNotNull('requisitions.action_by')
					->whereIn('requisitions.status', ['approved', 'on_hold', 'processing'])
					->groupBy('requisitions.status')
					->pluck('total', 'requisitions.status');
				$requisitions->put('new', 0);
			}
		}
		$rawDataArr = [
			"new" => 0,
			"processing" => 0,
			"on_hold" => 0,
			"approved" => 0,
		];
		$resultArr = $requisitions->toArray();
		return array_merge($rawDataArr, $resultArr);
	}

	private function getReturnDfStatus() {
		$returnObj = DfReturn::join('depot_users', 'depot_users.depot_id', '=', 'df_returns.depot_id')
			->where('depot_users.user_id', $this->user->id);
		if ($this->canApply) {
			$df_returns = $returnObj->select('df_returns.status', DB::raw('count(*) as total'))
				->where('df_returns.user_id', $this->user->id)
				->whereIn('df_returns.status', ['completed', 'on_hold', 'processing'])
				->whereRaw("IF(df_returns.status='processing',df_returns.action_by is not NULL,1)")
				->groupBy('df_returns.status')
				->pluck('total', 'df_returns.status');
			$objNew = clone $returnObj;
			$newCount = $objNew->where('df_returns.user_id', $this->user->id)
				->whereNull('df_returns.action_by')
				->where('df_returns.status', 'processing')
				->count();
			$df_returns->put('new', $newCount);
		} else {
			$sequence = $this->getStageSequence('return');
			if ($sequence) {
				$objNew = clone $returnObj;
				$df_returns = $returnObj->select('df_returns.status', DB::raw('count(*) as total'))
				//->whereNotNull('df_returns.action_by')
					->whereIn('df_returns.status', ['completed', 'on_hold', 'processing'])
					->whereRaw("IF(df_returns.status='processing',df_returns.stage != $sequence,1)")
					->groupBy('df_returns.status')
					->pluck('total', 'df_returns.status');
				$newCount = $objNew->where('stage', $sequence)->where('status', 'processing')->count();
				$df_returns->put('new', $newCount);
			} else {
				$df_returns = $returnObj->select('df_returns.status', DB::raw('count(*) as total'))
				//->whereNotNull('df_returns.action_by')
					->whereIn('df_returns.status', ['completed', 'on_hold', 'processing'])
					->groupBy('df_returns.status')
					->pluck('total', 'df_returns.status');
				$df_returns->put('new', 0);
			}
		}

		$rawDataArr = [
			"new" => 0,
			"processing" => 0,
			"on_hold" => 0,
			"completed" => 0,
		];
		$resultArr = $df_returns->toArray();
		return array_merge($rawDataArr, $resultArr);
	}

	private function damaeApplicationStatus() {
		$damageObj = DamageApplication::join('depot_users', 'depot_users.depot_id', '=', 'damage_applications.depot_id')
			->where('depot_users.user_id', $this->user->id);

		$objNew = clone $damageObj;

		$sequence = $this->getStageSequence('damage_application');
		if (!$sequence) {
			$sequence = 0;
		}

		$damage_applications = $damageObj->select('damage_applications.status', DB::raw('count(*) as total'))
			->whereIn('damage_applications.status', ['completed', 'on_hold', 'processing'])
			->whereRaw("IF(damage_applications.status='processing',damage_applications.stage != $sequence,1)")
			->groupBy('damage_applications.status')
			->pluck('total', 'damage_applications.status');

		$newCount = $objNew->where('stage', $sequence)->where('status', 'processing')->count();
		$damage_applications->put('new', $newCount);

		$rawDataArr = [
			"new" => 0,
			"processing" => 0,
			"on_hold" => 0,
			"completed" => 0,
		];
		$resultArr = $damage_applications->toArray();
		return array_merge($rawDataArr, $resultArr);
	}

	private function getComplainStatus() {
		$DfProblem = DfProblem::join('distributor_users', 'distributor_users.distributor_id', '=', 'df_problems.distributor_id')
			->where('distributor_users.user_id', auth()->id());

		$complain = collect([]);

		$DfProblem1 = clone $DfProblem;
		$problemsLast = $DfProblem1->whereIn('status', ['pending', 'processing'])
			->whereRaw('DATE(created_at)  = date_sub(curdate(), interval 1 day)')
			->count();
		$complain->put('last', $problemsLast);

		$DfProblem2 = clone $DfProblem;
		$problemsLatest = $DfProblem2->whereIn('status', ['pending', 'processing'])
			->whereRaw('DATE(created_at)  = curdate()')
			->count();
		$complain->put('latest', $problemsLatest);

		$DfProblem3 = clone $DfProblem;
		$problemsCurrentMonth = $DfProblem3->whereRaw('MONTH(created_at)  = MONTH(CURDATE())')
			->count();
		$complain->put('currentMonth', $problemsCurrentMonth);

		$DfProblem4 = clone $DfProblem;
		$problemsCurrentMonthSolved = $DfProblem4->where('status', 'completed')
			->whereRaw('MONTH(created_at)  = MONTH(CURDATE())')
			->count();
		$complain->put('currentMonthSolved', $problemsCurrentMonthSolved);

		$DfProblem5 = clone $DfProblem;
		$problemsLatestSolved = $DfProblem5->where('status', 'completed')
			->whereRaw('DATE(created_at)  = curdate()')
			->count();
		$complain->put('latestSolved', $problemsLatestSolved);

		$DfProblem6 = clone $DfProblem;
		$problemsLongPending = $DfProblem6->where('status', 'pending')
			->whereRaw('DATEDIFF(curdate(), Date(created_at)) > 3')
			->count();
		$complain->put('longPending', $problemsLongPending);

		return $complain;

	}
	private function regionalDfStatus() {
		$itemObj = Item::join('depots', 'depots.id', '=', 'items.depot_id')
			->join('depot_users', 'depot_users.depot_id', '=', 'depots.id')
			->where('depot_users.user_id', auth()->id())
			->orderBy('depots.region_id');

		$itemObj2 = clone $itemObj;

		//stock
		$stocks = $itemObj->select(DB::raw('1 as freeze_status'), 'depots.region_id', DB::raw('count(*) as total'))
			->whereIn('items.freeze_status', ['fresh', 'used'])
			->whereNull('items.item_status')
			->groupBy('depots.region_id');

		//Injected DF
		$injected = $itemObj2->select(DB::raw('2 as freeze_status'), 'depots.region_id', DB::raw('count(*) as total'))
			->whereIn('items.freeze_status', ['used', 'low_cooling', 'damage_applied'])
			->whereNotNull('shop_id')
			->whereNotNull('item_status')
			->groupBy('depots.region_id');

		$dataObj = $stocks->union($injected)->get();
		$uniqueRegionId = $dataObj->unique('region_id')->count();
		if ($uniqueRegionId > 1) {
			$mainArr = [];
			//dd($dataObj->toArray());
			$status = ['1' => 'Stock', '2' => 'Injected'];
			foreach ($dataObj as $obj) {
				$mainArr[$obj->region_id][$status[$obj->freeze_status]] = $obj->total;
			}

			$dataArr = [];
			foreach ($mainArr as $val) {

				if (array_key_exists('Stock', $val)) {
					$dataArr['Stock'][] = $val['Stock'];
				} else {
					$dataArr['Stock'][] = 0;
				}
				if (array_key_exists('Injected', $val)) {
					$dataArr['Injected'][] = $val['Injected'];
				} else {
					$dataArr['Injected'][] = 0;
				}
			}
			//dd($dataArr);
			$regions = Zone::whereIn('id', array_keys($mainArr))
				->orderBy('id')
				->pluck('name')
				->toArray();

			$colorArr = [
				'Stock' => [
					'backgroundColor' => 'rgba(0, 145, 123, 1)',
					'borderColor' => 'rgba(0, 145, 123, 1)',
				],
				'Injected' => [
					'backgroundColor' => 'rgba(181, 223, 187, 1)',
					'borderColor' => 'rgba(181, 223, 187, 1)',
				],
			];
			$regionsDfData['regions'] = json_encode($regions);
			$regionsDfData['data'] = json_encode($dataArr);
			$regionsDfData['colors'] = json_encode($colorArr);
		} else {
			$regionsDfData = false;
		}

		return $regionsDfData;

	}

	private function getMapData() {
		$regionCode = [
			'01' => 'Dhaka',
			'02' => 'Dhaka',
			'03' => 'Dhaka',
			'04' => 'Dhaka',
			'05' => 'Dhaka',
			'06' => 'Chittagong',
			'07' => 'Comilla',
			'08' => 'Sylhet',
			'09' => 'Khulna',
			'10' => 'Bogra',
		];

		$reverseArr = array_fill_keys(array_unique($regionCode), 0);

		$data = Item::join('shops', 'shops.id', '=', 'items.shop_id')
			->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
			->join('zones', 'zones.id', '=', 'shops.region_id')
			->where('distributor_users.user_id', auth()->id())
			->whereIn('items.freeze_status', ['used', 'low_cooling', 'damage_applied'])
			->whereNotNull('items.shop_id')
			->whereNotNull('items.item_status')
			->select('zones.code')
			->selectRaw('count(items.id) as total')
			->groupBy('zones.id', 'zones.code')
			->get();

		$outputs = [];
		foreach ($data as $key => $value) {
			if (array_key_exists($value->code, $regionCode)) {
				$regionName = $regionCode[$value->code];
				if (array_key_exists($regionCode[$value->code], $outputs)) {
					$outputs[$regionName] += $value->total;
				} else {
					$outputs[$regionName] = $value->total;
				}
			}
		}
		return collect(array_merge($reverseArr, $outputs));
	}
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$canApply = $this->canApply;
		$requisitions = $complainStatus = $df_returns = $damage_applications = $regionalDfStatus = false;

		$shops = $this->getOutletStatus();
		$items = $this->getDFStatus();
		//for payement verify
		$payments = $this->getPayment();
		$payment = $payments['payment'];
		$bkash = $payments['bkash'];

		$mapDatas = $this->getMapData();

		if (isMenuRender('RequisitionsController@index', $this->menu_list)) {
			$requisitions = $this->getRequistionCount();
		}

		if (isMenuRender('DfReturnsController@index', $this->menu_list)) {
			$df_returns = $this->getReturnDfStatus();
		}

		$depots = Depot::pluck('name', 'id');
		$depostDfStatus = $this->depotWiseDfStatus();

		$stockReceive = $this->waitToReceive();

		if (isMenuRender('ServicesController@problemEntryList', $this->menu_list)) {
			$complainStatus = $this->getComplainStatus();
		}
		if (isMenuRender('ServicesController@damageApplicationList', $this->menu_list)) {
			$damage_applications = $this->damaeApplicationStatus();
		}
		if (isMenuRender('InventoryReportsController@index', $this->menu_list)) {
			$regionalDfStatus = $this->regionalDfStatus();
		}

		return view('dashboards.index', compact('depots', 'items', 'shops', 'payment', 'bkash', 'canApply', 'requisitions', 'stockReceive', 'depostDfStatus', 'df_returns', 'complainStatus', 'regionalDfStatus', 'damage_applications', 'mapDatas'));
	}

	public function example(Request $request) {
		$request->validate([
			'name' => 'required|min:3|max:255',
		]);
		return collect($request->all());
	}

	// should be deleted after development
	public function pages($name = 'ui-elements_panels') {
		return view('pages.' . $name);
	}
}