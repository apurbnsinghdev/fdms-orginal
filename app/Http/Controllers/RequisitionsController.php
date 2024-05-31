<?php
namespace App\Http\Controllers;

use App\Brand;
use App\DepotUser;
use App\Designation;
use App\DfReturn;
use App\Document;
use App\Item;
use App\PhysicalVisit;
use App\Requisition;
use App\Role;
use App\Settlement;
use App\Shop;
use App\Size;
use App\Stage;
use App\Traits\DocumentsUpload;
use App\Traits\HasStageExists;
use App\Traits\SettlementCreateCloseData;
use App\Traits\SmsTrait;
use App\Traits\StockCheckTrait;
use App\User;
use Illuminate\Http\Request;

class RequisitionsController extends Controller {
	use DocumentsUpload, HasStageExists, SettlementCreateCloseData, StockCheckTrait, SmsTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($param = 'draft') {
		/*
			         * Note: Requisition has two type of user.
			         * 1. Apply aplication directly (executives group)
			         * 2. Apply aplication via any axecutive (stage user)
			         * Tab Defination:
			         * Draft:
			         * Executives group can create,edit,delete and view their own list (column: user_id)
			         * Stage user also can create,edit,delete and view their owl list (column: created_by)
			         * New:
			         * For executives group's: user_id = auth_user_id, action_by = NULL
			         * For stage user's: stage = auth_user_stage, stage_status= pending (for only own depot)[can make own action]
			         * Hold:
			         * For executives group's: user_id = auth_user_id, status = on_hold
			         * For stage user's: stage = auth_user_stage, status = on_hold (for only own depot)[can make own action without hold]
			         * Processing:
			         * For executives group's: user_id = auth_user_id, status = processing, action_by = Not NULL
			         * For stage user's: stage = auth_user_stage, status = processing, action_by = Not NULL (for only own depot)
			         * Approved:
			         * For executives group's: user_id = auth_user_id, status = approved
			         * For stage user's: stage = auth_user_stage, status = approved (for only own depot)
			         * Completed:
			         * For executives group's: user_id = auth_user_id, stage_status = approved, status = completed
			         * For stage user's: stage = auth_user_stage, stage_status = approved, status = completed (for only own depot)
			         * Cancelled:
			         * For executives group's: user_id = auth_user_id, status = cancelled
			         * For stage user's: stage = auth_user_stage, status = cancelled (for only own depot)
		*/
		if ($param == 'new') {
			$params = 'processing';
		} else {
			$params = $param;
		}

		$requisitionObj = Requisition::with([
			'creator' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'size' => function ($qu) {
				return $qu->select('id', 'name', 'installment');
			},
			'shop' => function ($qu) {
				return $qu->select('id', 'outlet_name', 'proprietor_name', 'mobile', 'category', 'address', 'estimated_sales');
			},
			'distributor' => function ($qu) {
				return $qu->select('id', 'outlet_name');
			},
			'stager' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'depot' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'physical_visits' => function ($qu) {
				return $qu->where('status', true)->select('requisition_id');
			},

		])
			->where('requisitions.status', $params)
			->select('requisitions.id', 'requisitions.type', 'requisitions.reference_id', 'requisitions.user_id', 'requisitions.item_id', 'requisitions.created_by', 'requisitions.action_by', 'requisitions.size_id', 'requisitions.shop_id', 'requisitions.depot_id', 'requisitions.payment_modes', 'requisitions.payment_methods', 'requisitions.payment_verified', 'requisitions.payment_confirm', 'requisitions.doc_verified', 'requisitions.df_return_id', 'requisitions.status', 'requisitions.stage', 'requisitions.validate_by', 'requisitions.distributor_id')
			->orderBy('requisitions.updated_at', 'desc');

		$isExecutiveGroup = Role::where('id', auth()->user()->role_id)->value('can_apply');
		// check upper or can apply group
		if (!$isExecutiveGroup) {
			$isExecutive = false;

			//$authUserDistributorList = DistributorUser::where('user_id', auth()->user()->id)
			//->pluck('distributor_id');

			// check existance in stage for auth user
			$stageArr = $this->getStageWithActionsAndSequence('requisition');
			$stageSequence = $stageArr['sequence'];
			$actionsArr = $stageArr['actions'];
			// get stage actions for auth user

			$requisitionObj->with([
				'user' => function ($qu) {
					return $qu->select('id', 'name');
				},
			]);
			if ($param == 'draft') {
				$requisitionObj->where('created_by', auth()->user()->id);
			} else if ($param == 'new') {
				$requisitionObj->where('stage', $stageSequence)->where('stage_status', 'pending');
			} else if ($param == 'processing') {
				$requisitionObj->where('stage', '<>', $stageSequence);
			} else if ($param == 'completed') {
				$requisitionObj->take(100);
			}

			//$requisitions = $requisitionObj->whereIn('distributor_id', $authUserDistributorList)->get();
			$requisitions = $requisitionObj->join('distributor_users', 'distributor_users.distributor_id', '=', 'requisitions.distributor_id')
				->where('distributor_users.user_id', auth()->user()->id)
				->get();
		} else {
			$isExecutive = true;
			$actionsArr = collect([]);
			$requisitionObj->where('user_id', auth()->user()->id);
			if ($param == 'new') {
				$requisitionObj->whereNull('action_by');
			} else if ($param == 'processing') {
				$requisitionObj->whereNotNull('action_by');
			}
			$requisitions = $requisitionObj->get();
		}

		return view('requisitions.index', compact('requisitions', 'param', 'isExecutive', 'actionsArr'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$hasExecutive = false;
		$salesExecutives = [];

		$userDepotList = DepotUser::where('user_id', auth()->user()->id)->pluck('depot_id');
		//$isExecutiveGroup = Role::where('id', auth()->user()->role_id)->value('can_apply');

		$canApplyGroup = Role::where('can_apply', true)->pluck('id');
		$eixtsInCanApplyGroup = $canApplyGroup->search(auth()->user()->role_id);

		if ($eixtsInCanApplyGroup === false) {

			$hasExecutive = true;
			$depotUserLists = DepotUser::whereIn('depot_id', $userDepotList)->pluck('user_id');

			$usersObj = User::with([
				'designation' => function ($q) {
					return $q->select('id', 'short_name');
				},
			])
				->whereIn('role_id', $canApplyGroup)
				->whereIn('id', $depotUserLists)
				->select('id', 'name', 'designation_id')
				->get();
			foreach ($usersObj as $value) {
				$salesExecutives[$value->id] = $value->name . '(' . $value->Designation->short_name . ')';
			}
		}
		$shops = Shop::join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
			->join('shops as distributors', 'distributors.id', '=', 'shops.distributor_id')
			->where('distributor_users.user_id', auth()->user()->id)
			->where('shops.status', 'active')
			->where('shops.is_distributor', false)
			->select('shops.id')
			->selectRaw("CONCAT(shops.outlet_name,'::',shops.mobile,' (',distributors.outlet_name, ')') as outlet_name")
			->orderBy('distributors.outlet_name')
			->pluck('outlet_name', 'shops.id');

		$sizes = Size::select('id', 'name', 'rent_amount')
			->where('availability', 'yes')
			->orderBy('name', 'asc')
			->get();

		return view('requisitions.create', compact('shops', 'sizes', 'hasExecutive', 'salesExecutives'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$data = $request->all();

		$physicallyVisitData = [];
		if (!empty($data['physically_visit'])) {
			$physicallyVisitData['status'] = $data['physically_visit'];
			unset($data['physically_visit']);
		}
		if (array_key_exists('user_id', $data)) {
			$validateArr = [
				'type' => 'required',
				'user_id' => 'required',
				'shop_id' => 'required',
				'size_id' => 'required',
				'payment_modes' => 'required',
				'distance_from_dist' => 'required | max:50',
			];
			$data['created_by'] = auth()->user()->id;
			$physicallyVisitData['user_id'] = $data['user_id'];
		} else {
			$validateArr = [
				'type' => 'required',
				'shop_id' => 'required',
				'size_id' => 'required',
				'payment_modes' => 'required',
				'distance_from_dist' => 'required | max:50',
				'money_receipt' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024',
				'deed_paper' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024',
			];
			$data['user_id'] = auth()->user()->id;
			$physicallyVisitData['user_id'] = $data['user_id'];
		}

		if ($data['type'] == 'replace') {
			$validateArr['current_df'] = 'required';
			$validateArr['comment'] = 'required';
		}
		if ($request->has('df_return_id')) {
			$validateArr['df_return_id'] = 'required';
		}
		if (isset($data['other_company'])) {
			$validateArr['other_company_df'] = 'required';
			if (isset($data['other_company_df'])) {
				$data['other_company_df'] = json_encode($data['other_company_df']);
			}

			unset($data['other_company']);
		} else {
			$data['other_company_df'] = NULL;
		}

		if ($data['payment_modes'] == 'full_paid' && !empty($data['size_id'])) {
			$sizeRentAmount = Size::select('rent_amount')->find($data['size_id']);
			$data['receive_amount'] = $sizeRentAmount->rent_amount ?: 0;
		}
		if ($data['payment_modes'] == 'concession') {
			$validateArr['receive_amount'] = 'required | numeric | not_in:0';
		}

		if (array_key_exists('draft', $data)) {
			$data['stage'] = 0;
			$data['status'] = 'draft';
			unset($data['draft']);
		}

		//requisition files upload
		$fieldsArr = [];
		$fileValidationArr = [];
		foreach (config('myconfig.requisition_file') as $value) {
			$receipt = $request->file($value);
			if ($receipt) {
				if ($value == 'money_receipt') {
					$data['payment_confirm'] = true;
				}
				$validateArr[$value] = 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024';
				$fieldsArr[$value] = $receipt;
				unset($data[$value]);
			}
		}
		//dd($data);
		//dd($validateArr);
		$request->validate($validateArr);
		// put shop's depot_id in every requisition
		$shop = Shop::with([
			'depot' => function ($q) {
				return $q->select('id', 'has_incharge');
			},
		])
			->select('depot_id', 'distributor_id')
			->find($data['shop_id']);
		//dd($data);
		if (array_key_exists('send', $data)) {
			if ($shop->depot->has_incharge) {
				if ($this->checkFirstStageSupervisor($shop->distributor_id)) {
					$data['stage'] = 1;
				} else {
					$data['stage'] = 2;
				}
			} else {
				$data['stage'] = 2;
			}
			unset($data['send']);
			if ($data['payment_modes'] != 'without_rent') {
				$validateArr2['payment_methods'] = 'required';
				$request->validate($validateArr2);
			}
			//check stock availability
			if (empty($data['df_return_id'])) {
				$totalItem = $this->checkAvailableStock($data['size_id'], null, $shop->depot_id);
				if ($totalItem < 1) {
					$message = "Stock is not available";
					return redirect()->route('requisitions.create')->with('flash_danger', $message);
				}
			}
		}
		$data['depot_id'] = $shop->depot_id;
		$data['distributor_id'] = $shop->distributor_id;
		//when requisition type is replace and send application then current df locked
		if (isset($data['current_df']) && $request->has('send')) {
			$lockArrData = (object) ['shop_id' => $data['shop_id'], 'current_df' => $data['current_df']];
			$responseError = $this->settlementLockUnlock($lockArrData);
			if ($responseError) {
				return $responseError;
			}
		}
		//if payment modes is without rent then clear amount and payment methods
		if ($data['payment_modes'] == 'without_rent') {
			$data['receive_amount'] = null;
			$data['payment_methods'] = null;

		}
		// put reperence id
		$requisition = Requisition::create($data);
		if ($requisition) {
			//if return df tagged in shop
			if (!empty($data['df_return_id']) && $request->has('send')) {
				DfReturn::where('id', $data['df_return_id'])
					->update(['is_requisition_created' => true]);
			}
			//data insert for physical visit
			$physicallyVisitData['requisition_id'] = $requisition->id;
			PhysicalVisit::create($physicallyVisitData);
			// create reference id
			$readAbleDepotId = number_pad($requisition->depot_id, 2);
			if (strlen($requisition->id) <= 5) {
				$insertedId = number_pad($requisition->id, 5);
			} else {
				$insertedId = number_pad($requisition->id, strlen($requisition->id));
			}
			$requisition->update([
				'reference_id' => $readAbleDepotId . $insertedId,
			]);
			//file uploads
			if (count($fieldsArr)) {
				if ($requisition->payment_modes == 'without_rent' || $requisition->payment_methods == 'bkash') {
					unset($fieldsArr['money_receipt']);
				}
				$this->storeDucuments($fieldsArr, $requisition, 'requisition');
			}
			$message = "You have successfully created";
			return redirect()->route('requisitions.index', [$requisition->status == 'draft' ? 'draft' : 'new'])->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('requisitions.create')->with('flash_danger', $message);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		dd($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$requisitions = Requisition::with([
			'shop' => function ($q) {
				return $q->with(['distributor' => function ($q) {
					return $q->select('id', 'outlet_name');
				}])
					->select('id', 'distributor_id', 'outlet_name', 'mobile');
			},
			'physical_visits' => function ($q) {
				return $q->where('stage', false)->select('requisition_id', 'status')->first();
			},
		])
			->findOrFail($id);

		if ($requisitions->type == 'replace') {
			$itemIds = \App\Settlement::where('shop_id', $requisitions->shop_id)
				->where('status', '<>', 'closed')
				->pluck('item_id');
			$currentdfs = Item::whereIn('id', $itemIds)->pluck('serial_no', 'id');
		} else {
			$currentdfs = '';
		}

		$documents = Document::where('shop_id', $requisitions->shop_id)
			->where(function ($query) {
				$query->where('module', 'requisition')
					->orWhereNull('module');
			})
			->where(function ($query) use ($requisitions) {
				$query->where('data_id', $requisitions->id)
					->orWhereNull('data_id');
			})
			->pluck('file_name', 'field_name');
		$hasExecutive = false;
		$isExecutiveGroup = Role::where('id', auth()->user()->role_id)->value('can_apply');

		if (!$isExecutiveGroup) {
			$hasExecutive = true;
			if ($requisitions->created_by != auth()->user()->id) {
				$message = "Something wrong!! Please try again";
				return redirect()->route('requisitions.index')->with('flash_danger', $message);
			}
		} else {
			if ($requisitions->user_id != auth()->user()->id) {
				$message = "Something wrong!! Please try again";
				return redirect()->route('requisitions.index')->with('flash_danger', $message);
			}
		}

		if ($requisitions->status == 'draft') {

			$dfreturns = \App\DfReturn::select('df_returns.id', 'items.serial_no', 'shops.outlet_name', 'items.size_id')
				->join('items', 'items.id', '=', 'df_returns.current_df')
				->join('shops', 'shops.id', '=', 'df_returns.shop_id')
				->where('to_shop', $requisitions->shop_id)
				->where('df_returns.status', '<>', 'cancelled')
				->where('df_returns.is_requisition_created', false)
				->get();
			if ($dfreturns->isNotEmpty()) {
				$sizeIds = $dfreturns->pluck('size_id', 'size_id');
				$sizes = Size::whereIn('id', $sizeIds->values())->orderBy('name', 'asc')->select('id', 'name', 'rent_amount')->get();
			} else {
				$sizes = Size::orderBy('name', 'asc')->select('id', 'name', 'rent_amount')->get();
			}

			return view('requisitions.edit', compact('requisitions', 'sizes', 'hasExecutive', 'documents', 'currentdfs', 'dfreturns'));
		} else {
			if (!$hasExecutive) {
				return view('requisitions.upload_files', compact('requisitions', 'documents'));
			} else {
				$message = "Something wrong!! Please try again";
				return redirect()->route('requisitions.index')->with('flash_danger', $message);
			}
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$data = $request->except([
			'_method',
			'_token',
		]);
		//dd($data);
		if (array_key_exists('user_id', $data)) {
			$validateArr = [
				'user_id' => 'required',
				'size_id' => 'required',
				'payment_modes' => 'required',
				'distance_from_dist' => 'required | max:50',
			];
		} else {
			$validateArr = [
				'size_id' => 'required',
				'payment_modes' => 'required',
				'distance_from_dist' => 'required | max:50',
			];
		}

		if (isset($data['type']) && $data['type'] == 'replace') {
			$validateArr['current_df'] = 'required';
			$validateArr['comment'] = 'required';
		}

		$physicallyVisitData = [];
		if (!$request->has('upload_file')) {

			if ($request->has('df_return_id')) {
				$validateArr['df_return_id'] = 'required';
			} else {
				$data['df_return_id'] = null;
			}

			if (!empty($data['physically_visit'])) {
				$physicallyVisitData['status'] = $data['physically_visit'];
				unset($data['physically_visit']);
			} else {
				$physicallyVisitData['status'] = 0;
			}
			if (!empty($data['user_id'])) {
				$physicallyVisitData['user_id'] = $data['user_id'];
			}

			if (isset($data['other_company'])) {
				$validateArr['other_company_df'] = 'required';
				if (isset($data['other_company_df'])) {
					$data['other_company_df'] = json_encode($data['other_company_df']);
				}

				unset($data['other_company']);
			} else {
				$data['other_company_df'] = NULL;
			}

			if (empty($data['exclusive_outlet'])) {
				$data['exclusive_outlet'] = 0;
			}
			if ($data['payment_modes'] == 'full_paid' && !empty($data['size_id'])) {
				$sizeRentAmount = Size::select('rent_amount')->find($data['size_id']);
				$data['receive_amount'] = $sizeRentAmount->rent_amount ?: 0;
			}
			if ($data['payment_modes'] == 'concession') {
				$validateArr['receive_amount'] = 'required | numeric | not_in:0';
			}

			if ($data['payment_modes'] == 'without_rent') {
				$data['receive_amount'] = null;
				$data['payment_methods'] = null;
			}
		} else {
			unset($data['size_id'], $data['distance_from_dist'], $data['upload_file']);
		}

		// put shop's depot_id in every requisition
		$currentRequisitionData = Requisition::with([
			'depot' => function ($q) {
				return $q->select('id', 'has_incharge');
			},
		])
			->select('id', 'depot_id', 'shop_id', 'reference_id', 'current_df', 'distributor_id')
			->find($id);

		if (array_key_exists('send', $data)) {
			$data['status'] = 'processing';
			$data['created_at'] = \Carbon\Carbon::now(); //application date set
			if ($currentRequisitionData->depot->has_incharge) {
				if ($this->checkFirstStageSupervisor($currentRequisitionData->distributor_id)) {
					$data['stage'] = 1;
				} else {
					$data['stage'] = 2;
				}
			} else {
				$data['stage'] = 2;
			}
			unset($data['send']);
			if ($data['payment_modes'] != 'without_rent') {
				$validateArr['payment_methods'] = 'required';
			}
			//check stock availability
			if (empty($data['df_return_id'])) {
				$totalItem = $this->checkAvailableStock($data['size_id'], null, $currentRequisitionData->depot_id);
				if ($totalItem < 1) {
					$message = "Stock is not available";
					return redirect()->back()->with('flash_danger', $message);
				}
			}
		}

		//requisition files upload
		$fieldsArr = [];
		$oldFieldsArr = [];
		foreach (config('myconfig.requisition_file') as $value) {
			$validateArr[$value] = 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024';
			$receipt = $request->file($value);
			if ($receipt) {
				if ($value == 'money_receipt') {
					$data['payment_confirm'] = true;
				}
				$fieldsArr[$value] = $receipt;
				unset($data[$value]);
			}

			if (array_key_exists('old_' . $value, $data)) {
				$oldFieldsArr['old_' . $value] = $data['old_' . $value];
				unset($data['old_' . $value]);
			}
		}

		//shop files upload
		$fieldsArr2 = [];
		$oldFieldsArr2 = [];
		foreach (config('myconfig.shop_file') as $value) {
			$validationArr[$value] = 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024';
			$receipt = $request->file($value);
			if ($receipt) {
				$fieldsArr2[$value] = $receipt;
				unset($data[$value]);
			}
			if (array_key_exists('old_' . $value, $data)) {
				$oldFieldsArr2['old_' . $value] = $data['old_' . $value];
				unset($data['old_' . $value]);
			}
		}

		if ($data['payment_modes'] == 'without_rent' || $data['payment_methods'] == 'bkash') {
			$data['payment_confirm'] = false;
		}
		$request->validate($validateArr);
		if (isset($data['current_df']) && $request->has('send')) {
			if ($data['current_df'] != $currentRequisitionData->current_df) {
				//new current df will be lock
				$lockArrData = (object) ['shop_id' => $currentRequisitionData['shop_id'], 'current_df' => $data['current_df']];
				$responseError = $this->settlementLockUnlock($lockArrData);
				if ($responseError) {
					return $responseError;
				}
				//inserted current df will be unlock
				$this->settlementLockUnlock($currentRequisitionData, true);
			} else {
				$lockArrData = (object) ['shop_id' => $currentRequisitionData['shop_id'], 'current_df' => $data['current_df']];
				$responseError = $this->settlementLockUnlock($lockArrData);
				if ($responseError) {
					return $responseError;
				}
			}
		}
		$requisition = Requisition::where('id', $id)->update($data);
		if ($requisition) {
			//if return df tagged in shop
			if (!empty($data['df_return_id']) && $request->has('send')) {
				DfReturn::where('id', $data['df_return_id'])
					->update(['is_requisition_created' => true]);
			}
			//update physical vistit
			if (!empty($physicallyVisitData)) {
				PhysicalVisit::where('requisition_id', $id)->where('stage', 0)->update($physicallyVisitData);
			}
			//requisition file uploads
			if (count($fieldsArr)) {
				if ($data['payment_modes'] == 'without_rent' || $data['payment_methods'] == 'bkash') {
					unset($fieldsArr['money_receipt']);
					unset($oldFieldsArr['old_money_receipt']);
				}
				$this->storeDucuments($fieldsArr, $currentRequisitionData, 'requisition', $oldFieldsArr);
			}
			//shop file uploads
			$shopId['id'] = $currentRequisitionData->shop_id;
			if (count($fieldsArr2)) {
				$this->storeDucuments($fieldsArr2, (object) $shopId, null, $oldFieldsArr2);
			}

			$message = "You have successfully created";
			return redirect()->route('requisitions.index', [$request->has('send') ? 'new' : 'draft'])->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->back()->with('flash_danger', $message);
		}
	}

	private function resendStore(Request $request, $id) {
		$data = $request->except([
			'_method',
			'_token',
		]);
		if (array_key_exists('user_id', $data)) {
			$validateArr = [
				'user_id' => 'required',
				'size_id' => 'required',
				'payment_modes' => 'required',
				'distance_from_dist' => 'required | max:50',
			];
		} else {
			$validateArr = [
				'size_id' => 'required',
				'payment_modes' => 'required',
				'distance_from_dist' => 'required | max:50',
			];
		}

		if (isset($data['type']) && $data['type'] == 'replace') {
			$validateArr['current_df'] = 'required';
		}
		if ($request->has('df_return_id')) {
			$validateArr['df_return_id'] = 'required';
		} else {
			$data['df_return_id'] = null;
		}

		$physicallyVisitData = [];
		if (!empty($data['physically_visit'])) {
			$physicallyVisitData['status'] = $data['physically_visit'];
			unset($data['physically_visit']);
		} else {
			$physicallyVisitData['status'] = 0;
		}

		if (!empty($data['user_id'])) {
			$physicallyVisitData['user_id'] = $data['user_id'];
		}

		if (isset($data['other_company'])) {
			$validateArr['other_company_df'] = 'required';
			if (isset($data['other_company_df'])) {
				$data['other_company_df'] = json_encode($data['other_company_df']);
			}

			unset($data['other_company']);
		} else {
			$data['other_company_df'] = NULL;
		}

		if (empty($data['exclusive_outlet'])) {
			$data['exclusive_outlet'] = 0;
		}
		if ($data['payment_modes'] == 'full_paid' && !empty($data['size_id'])) {
			$sizeRentAmount = Size::select('rent_amount')->find($data['size_id']);
			$data['receive_amount'] = $sizeRentAmount->rent_amount ?: 0;
		}
		if ($data['payment_modes'] == 'concession') {
			$validateArr['receive_amount'] = 'required | numeric | not_in:0';
		}

		if ($data['payment_modes'] == 'without_rent') {
			$data['receive_amount'] = 0;
		} else {
			$validateArr['payment_methods'] = 'required';
		}

		$data['stage_status'] = 'pending'; //on_hold status to pending
		$data['status'] = 'processing'; //on_hold status to processing

		// put shop's depot_id in every requisition
		$currentRequisitionData = Requisition::with([
			'depot' => function ($q) {
				return $q->select('id', 'has_incharge');
			},
		])
			->select('id', 'depot_id', 'shop_id', 'reference_id', 'current_df', 'receive_amount')
			->find($id);

		if ($data['receive_amount'] != $currentRequisitionData->receive_amount) {
			$data['payment_confirm'] = false;
		}

		//requisition files upload
		$fieldsArr = [];
		$oldFieldsArr = [];
		foreach (config('myconfig.requisition_file') as $value) {
			$validateArr[$value] = 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024';
			$receipt = $request->file($value);
			if ($receipt) {
				if ($value == 'money_receipt') {
					$data['payment_confirm'] = true;
				}
				$fieldsArr[$value] = $receipt;
				unset($data[$value]);
			}

			if (array_key_exists('old_' . $value, $data)) {
				$oldFieldsArr['old_' . $value] = $data['old_' . $value];
				unset($data['old_' . $value]);
			}
		}

		$request->validate($validateArr);

		if (isset($data['current_df'])) {
			if ($data['current_df'] != $currentRequisitionData->current_df) {
				//new current df will be lock
				$lockArrData = (object) ['shop_id' => $currentRequisitionData['shop_id'], 'current_df' => $data['current_df']];
				$responseError = $this->settlementLockUnlock($lockArrData);
				if ($responseError) {
					return $responseError;
				}
				//inserted current df will be unlock
				$this->settlementLockUnlock($currentRequisitionData, true);
			}
		}
		$requisition = Requisition::where('id', $id)->update($data);
		if ($requisition) {
			//if return df tagged in shop
			if (!empty($data['df_return_id'])) {
				DfReturn::where('id', $data['df_return_id'])
					->update(['is_requisition_created' => true]);
			}
			//update physical vistit
			if (!empty($physicallyVisitData)) {
				PhysicalVisit::where('requisition_id', $id)->where('stage', 0)->update($physicallyVisitData);
			}
			if (count($fieldsArr)) {
				if ($data['payment_modes'] == 'without_rent' || $data['payment_methods'] == 'bkash') {
					unset($fieldsArr['money_receipt']);
					unset($oldFieldsArr['old_money_receipt']);
				}
				$this->storeDucuments($fieldsArr, $currentRequisitionData, 'requisition', $oldFieldsArr);
			}

			$message = "You have successfully re-sended";
			return redirect()->route('requisitions.index', ['processing'])->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->back()->with('flash_danger', $message);
		}
	}

	public function resend(Request $request, $id) {
		if ($request->isMethod('put')) {
			return $this->resendStore($request, $id);
		}
		$requisitions = Requisition::with([
			'shop' => function ($q) {
				return $q->select('id', 'outlet_name');
			},
			'physical_visits' => function ($q) {
				return $q->where('stage', false)->select('requisition_id', 'status')->first();
			},
		])
			->findOrFail($id);

		if ($requisitions->type == 'replace') {
			$itemIds = \App\Settlement::where('shop_id', $requisitions->shop_id)
				->where('status', '<>', 'closed')
				->pluck('item_id');
			$currentdfs = Item::whereIn('id', $itemIds)->pluck('serial_no', 'id');
		} else {
			$currentdfs = '';
		}

		$documents = Document::where('data_id', $id)
			->where('module', 'requisition')
			->pluck('file_name', 'field_name');

		$hasExecutive = false;
		$isExecutiveGroup = Role::where('id', auth()->user()->role_id)->value('can_apply');

		if (!$isExecutiveGroup) {
			$hasExecutive = true;
			if ($requisitions->created_by != auth()->user()->id) {
				$message = "Something wrong!! Please try again";
				return redirect()->route('requisitions.index')->with('flash_danger', $message);
			}
		} else {
			if ($requisitions->user_id != auth()->user()->id) {
				$message = "Something wrong!! Please try again";
				return redirect()->route('requisitions.index')->with('flash_danger', $message);
			}
		}

		$dfreturns = \App\DfReturn::select('df_returns.id', 'items.serial_no', 'shops.outlet_name', 'items.size_id')
			->join('items', 'items.id', '=', 'df_returns.current_df')
			->join('shops', 'shops.id', '=', 'df_returns.shop_id')
			->where('to_shop', $requisitions->shop_id)
			->where('df_returns.status', '<>', 'cancelled')
			->where('df_returns.is_requisition_created', false)
			->get();
		if ($dfreturns->isNotEmpty()) {
			$sizeIds = $dfreturns->pluck('size_id', 'size_id');
			$sizes = Size::whereIn('id', $sizeIds->values())->orderBy('name', 'asc')->select('id', 'name', 'rent_amount')->get();
		} else {
			$sizes = Size::orderBy('name', 'asc')->select('id', 'name', 'rent_amount')->get();
		}
		return view('requisitions.resend', compact('requisitions', 'sizes', 'hasExecutive', 'documents', 'currentdfs', 'dfreturns'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$requisition = Requisition::findOrFail($id);
		if ($requisition->status == 'draft') {
			$documents = Document::where('data_id', $id)->get();
			$physically_visit = PhysicalVisit::where('requisition_id', $id)->exists();
			if ($documents->count()) {
				foreach ($documents as $key => $document) {
					\Storage::delete('images/' . $requisition->shop_id . '/' . $document->file_name);
					$document->delete();
				}
			}
			if ($physically_visit) {
				PhysicalVisit::where('requisition_id', $id)->delete();
			}
			$requisition->delete();
			$message = "Successfully deleted this item.";
			return redirect()->route('requisitions.index')->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('requisitions.index')->with('flash_danger', $message);
		}
	}

	public function payment_verify(Request $request, $id) {
		$isExecutiveGroup = Role::where('id', auth()->user()->role_id)->value('can_apply');
		if ($isExecutiveGroup) {
			$message = "Something wrong!! Please try again";
			return redirect()->back()->with('flash_danger', $message);
		}
		$requisition = Requisition::with([
			'size' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'depot' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'shop' => function ($qu) {
				return $qu->select('id', 'outlet_name');
			},
			'payment_verifier' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'documents' => function ($q) {
				return $q->where('field_name', 'money_receipt')
					->select('data_id', 'file_name');
			},
		])->where('payment_modes', '<>', 'without_rent')
			->where('payment_methods', '<>', 'bkash')
			->findOrFail($id);

		if (!$requisition->payment_confirm || ($requisition->doc_verified != 'yes')) {
			$message = "Document is not verified yet.";
			return redirect()->route('requisitions.index', 'approved')->with('flash_danger', $message);
		}

		// dd($requisition->toArray());
		if ($request->isMethod('put')) {
			$data = $request->all();
			$updateableData = [];
			$fieldsArr = [];
			$oldFieldsArr = [];
			if (isset($data['verified'])) {
				$updateableData['payment_verified'] = 'yes';
				$updateableData['payment_verrified_by'] = auth()->user()->id;
				$message = "Payment verified.";
			} else {
				$updateableData['payment_verified'] = 'no';
				$updateableData['payment_verrified_by'] = auth()->user()->id;
				$message = "Payment not verified.";
			}
			if (count($updateableData)) {
				$requisitionData = $requisition->update($updateableData);
			} else {
				$requisitionData = true;
			}
			if ($requisitionData) {
				return redirect()->route('requisitions.payment_verify', $id)->with('flash_success', $message);
			} else {
				$message = "Something wrong!! Please try again";
				return redirect()->route('requisitions.payment_verify', $id)->with('flash_danger', $message);
			}
		}
		return view('requisitions.payment_verify', compact('requisition'));
	}

	public function bkash_verify(Request $request, $id) {
		$isExecutiveGroup = Role::where('id', auth()->user()->role_id)->value('can_apply');
		if ($isExecutiveGroup) {
			$message = "Something wrong!! Please try again";
			return redirect()->back()->with('flash_danger', $message);
		}
		$requisition = Requisition::with([
			'size' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'depot' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'shop' => function ($qu) {
				return $qu->select('id', 'outlet_name');
			},
			'bkashes',
			'payment_verifier' => function ($qu) {
				return $qu->select('id', 'name');
			},
		])->where('payment_modes', '<>', 'without_rent')
			->where('payment_methods', 'bkash')
			->findOrFail($id);

		if (!$requisition->payment_confirm) {
			$message = "Payment is not received yet.";
			return redirect()->back()->with('flash_danger', $message);
		}

		// dd($requisition->toArray());
		if ($request->isMethod('put')) {
			$data = $request->all();
			if (isset($data['verified'])) {
				$requisition->update([
					'payment_verified' => 'yes',
					'payment_verrified_by' => auth()->user()->id,
				]);
				$message = "Payment verified.";
			} else {
				$requisition->update([
					'payment_verified' => 'no',
					'payment_verrified_by' => auth()->user()->id,
				]);
				$message = "Payment not verified.";
			}

			return redirect()->route('requisitions.bkash_verify', $id)->with('flash_success', $message);
		}
		return view('requisitions.bkash_verify', compact('requisition'));
	}

	public function document_verify(Request $request, $id) {
		$requisition = Requisition::with([
			'shop' => function ($q) {
				return $q->select('id', 'outlet_name');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
		])
			->findOrFail($id);

		$isExecutiveGroup = Role::where('id', auth()->user()->role_id)->value('can_apply');
		if ($isExecutiveGroup && $requisition->user_id != auth()->id()) {
			$message = "Something wrong!! Please try again";
			return redirect()->back()->with('flash_danger', $message);
		}

		$documents = Document::where('shop_id', $requisition->shop_id)
			->where(function ($query) use ($requisition) {
				$query->where('module', 'requisition')
					->orWhereNull('module');
			})
			->where(function ($query) use ($requisition) {
				$query->where('data_id', $requisition->id)
					->orWhereNull('data_id');
			})
			->pluck('file_name', 'field_name');
		$shopObj = new \stdClass();
		$shopObj->id = $requisition->shop_id;
		if ($request->isMethod('put')) {
			$requisitionFileArr = config('myconfig.requisition_file');
			$shopFileArr = config('myconfig.shop_file');
			if ($requisition->status == 'completed') {
				$requisitionFileArr = ['deed_paper'];
				$shopFileArr = [];
			} else {

				if ($requisition->payment_verified == 'yes' OR $requisition->payment_methods == 'bkash') {
					unset($requisitionFileArr[array_search('money_receipt:', $requisitionFileArr)]);
				}
				unset($requisitionFileArr[array_search('deed_paper', $requisitionFileArr)]);
			}

			$data = $request->all();
			$updateableData = [];

			if (isset($data['verified'])) {
				$updateableData['doc_verified'] = 'yes';
			} else if (isset($data['notVerified'])) {
				$updateableData['doc_verified'] = 'no';
			}
			$updateableData['doc_verified_by'] = auth()->user()->id;
			//requisition files upload
			$fieldsArr = [];
			$oldFieldsArr = [];
			$validationArr = [];
			foreach ($requisitionFileArr as $value) {
				$validationArr[$value] = 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024';
				$receipt = $request->file($value);
				if ($receipt) {
					if ($value == 'money_receipt') {
						$updateableData['payment_confirm'] = true;
					}
					$fieldsArr[$value] = $receipt;
				}

				if (array_key_exists('old_' . $value, $data)) {
					$oldFieldsArr['old_' . $value] = $data['old_' . $value];
				} else {
					if (isset($data['verified'])) {
						$validationArr[$value] = 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:1024';
					}

				}
			}
			//shop files upload
			$fieldsArr2 = [];
			$oldFieldsArr2 = [];
			foreach ($shopFileArr as $value) {
				$validationArr[$value] = 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024';
				$receipt = $request->file($value);
				if ($receipt) {
					$fieldsArr2[$value] = $receipt;
				}
				if (array_key_exists('old_' . $value, $data)) {
					$oldFieldsArr2['old_' . $value] = $data['old_' . $value];

				} else {
					if (isset($data['verified'])) {
						$validationArr[$value] = 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:1024';
					}

				}
			}
			//validation
			//dd($validationArr);
			$request->validate($validationArr);
			if (count($updateableData)) {
				$requisitionData = $requisition->update($updateableData);
			} else {
				$requisitionData = true;
			}

			if ($requisitionData) {

				if (count($fieldsArr)) {
					$this->storeDucuments($fieldsArr, $requisition, 'requisition', $oldFieldsArr);
				}
				if (count($fieldsArr2)) {
					$this->storeDucuments($fieldsArr2, $shopObj, null, $oldFieldsArr2);
				}
				$message = "You have successfully updated";
				if (isset($data['verified'])) {
					return redirect()->route('requisitions.index', 'approved')->with('flash_success', $message);
				} else {
					return redirect()->route('requisitions.document_verify', $id)->with('flash_success', $message);
				}

			} else {
				$message = "Something wrong!! Please try again";
				return redirect()->route('requisitions.document_verify', $id)->with('flash_danger', $message);
			}

		}
		return view('requisitions.document_verify', compact('requisition', 'documents', 'deed_paper'));
	}
	private function itemTagged($request, $requisitionObj) {
		$data = $request->all();
		if (array_key_exists('serial_no', $data)) {
			//this logic is not using may be
			$request->validate([
				'serial_no' => 'required|size:7',
			]);

			$request['serial'] = $data['pre_serial'] . $data['serial_no'];

			$request->validate([
				'serial' => 'unique:items,serial_no',
			]);
			$itemObj = Item::find($data['id']);
			$itemData = [
				'shop_id' => $requisitionObj->shop_id,
				'requisition_id' => $requisitionObj->id,
				'serial_no' => $request['serial'],
				'item_status' => 'reserve',
			];
			if ($itemObj->freeze_status == 'fresh') {
				$itemData['freeze_status'] = 'used';
			}

			$brandsWithAvalilableQTY = $this->calculateAvailabeDFStock($requisitionObj->depot_id, $requisitionObj->size_id, $itemObj->brand_id); //check if already run out mipellim (16-may-2019)
			if ($brandsWithAvalilableQTY->count()) {
				$itemObj->update($itemData);
				$requisitionObj->update(['item_id' => $data['id']]);
			} else {
				$message = "This DF is already run out. Please try another.";
				return redirect()->route('requisitions.freeze_assign', $requisitionObj->id)->with('flash_danger', $message);
			}

		} else if (array_key_exists('item_id', $data)) {
			//this logic is using
			$request->validate([
				'item_id' => 'required',
			]);
			$itemObj = Item::find($data['item_id']);
			$itemData = [
				'shop_id' => $requisitionObj->shop_id,
				'requisition_id' => $requisitionObj->id,
				'item_status' => 'reserve',
			];
			if ($itemObj->freeze_status == 'fresh') {
				$itemData['freeze_status'] = 'used';
			}
			
			//if assingn a return df then brandsWithAvalilableQTY will be false
			if(!empty($requisitionObj->df_return_id)){
                $brandsWithAvalilableQTY = 1;
			}else{
			    $brandsWithAvalilableQTY = $this->calculateAvailabeDFStock($requisitionObj->depot_id, $requisitionObj->size_id, $itemObj->brand_id); //check if already run out mipellim (16-may-2019)
			    $brandsWithAvalilableQTY = $brandsWithAvalilableQTY->count();
			}
			//$brandsWithAvalilableQTY = $this->calculateAvailabeDFStock($requisitionObj->depot_id, $requisitionObj->size_id, $itemObj->brand_id); //check if already run out mipellim (16-may-2019)
			if ($brandsWithAvalilableQTY > 0) {
				$itemObj->update($itemData);
				$requisitionObj->update(['item_id' => $data['item_id']]);
			} else {
				$message = "This DF is already run out. Please try another.";
				return redirect()->route('requisitions.freeze_assign', $requisitionObj->id)->with('flash_danger', $message);
			}
		} else {
			$message = "Something is wrong.";
			return redirect()->route('requisitions.freeze_assign', $requisitionObj->id)->with('flash_danger', $message);
		}
		$message = "Item has assigned successfully.";
		return redirect()->route('requisitions.index', 'approved')->with('flash_success', $message);
	}

	public function freeze_assign(Request $request, $id) {
		$requisition = Requisition::with([
			'payment_verifier' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'size' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'shop' => function ($qu) {
				return $qu->select('id', 'outlet_name', 'proprietor_name', 'mobile');
			},
			'depot' => function ($qu) {
				return $qu->select('id', 'name');
			}])
			->findOrFail($id);

		if ($requisition->doc_verified != 'yes' || $requisition->payment_verified != 'yes' || $requisition->status != 'approved') {
			if ($requisition->doc_verified != 'yes') {
				$message = "Document is not verified yet.";
			}
			if ($requisition->payment_verified != 'yes') {
				$message = "Payment is not verified yet.";
			}
			if ($requisition->status != 'approved') {
				$message = "Requisition is not approved yet.";
			}
			return redirect()->route('requisitions.index', 'approved')->with('flash_danger', $message);
		}
		if ($requisition->item_id) {
			$message = "Item already assigned.";
			return redirect()->route('requisitions.index', 'approved')->with('flash_danger', $message);
		}

		if ($request->isMethod('post')) {
			return $this->itemTagged($request, $requisition);
		} else {
			$items = collect([]);
			$brands = collect([]);
			$selectedBrandId = null;
			$slectedItems = collect([]);
			$msg = 'There is no avilable DF for assign.';
			$noOfTotalDF = 0;

			if ($requisition->df_return_id) {
				$items = Item::join('df_returns', 'df_returns.current_df', '=', 'items.id')
					->where('df_returns.id', $requisition->df_return_id)
					->where('df_returns.status', 'completed')
					->whereNull('items.item_status')
					->select(\DB::raw("CONCAT(items.serial_no,'(',items.freeze_status,') [RETURN DF]') AS serial_no"), 'items.id')
					->pluck('serial_no', 'id');
				if ($items->count()) {
					$noOfTotalDF = $items->count();
				} else {
					$serialNo = DfReturn::select('items.serial_no')
						->join('items', 'items.id', '=', 'df_returns.current_df')
						->find($requisition->df_return_id);
					$msg = 'DF: "' . $serialNo->serial_no . '" is in returning process and waiting for approval.';
				}

			} else {
				$returnDfs = Item::join('df_returns', 'df_returns.current_df', '=', 'items.id')
					->where('df_returns.to_shop', $requisition->shop_id)
					->where('df_returns.is_requisition_created', false)
					->whereNull('items.item_status')
					->where('df_returns.status', 'completed')
					->select(\DB::raw("CONCAT(items.serial_no,'(',items.freeze_status,') [RETURN DF]') AS serial_no"), 'items.id')
					->pluck('serial_no', 'id');

				$brandsWithAvalilableQTY = $this->calculateAvailabeDFStock($requisition->depot_id, $requisition->size_id);
				if ($brandsWithAvalilableQTY->count()) {
					$itemObj = Item::availableDFQty()
						->where('depot_id', $requisition->depot_id)
						->where('size_id', $requisition->size_id)
						->whereIn('brand_id', $brandsWithAvalilableQTY->keys());

					if ($itemObj->exists()) {
						$itemObjForWithoutSerial = clone $itemObj;
						$noOfTotalDF = $itemObj->count();
						$items = $itemObj->whereNotNull('serial_no')
							->select(\DB::raw("CONCAT(serial_no,'(',freeze_status,')') AS serial_no"), 'id')
							->pluck('serial_no', 'id');

						$slectedItems = $itemObjForWithoutSerial->whereNull('serial_no')
							->pluck('id', 'brand_id');

						$brands = Brand::whereIn('id', $slectedItems->keys())->pluck('short_code', 'id');
					}
				}

				if ($returnDfs->count()) {
					foreach ($returnDfs as $key => $value) {
						$items->prepend($value, $key);
					}
				}

			}

			return view('requisitions.freeze_assign', compact('requisition', 'items', 'noOfTotalDF', 'msg', 'brands', 'slectedItems'));
		}
	}

	public function generate_gatepass(Request $request, $id) {
		$isExecutiveGroup = Role::where('id', auth()->user()->role_id)->value('can_apply');
		if ($isExecutiveGroup) {
			$message = "Something wrong!! Please try again";
			return redirect()->back()->with('flash_danger', $message);
		}
		$reqisition = Requisition::with([
			'shop' => function ($q) {
				return $q->select('id', 'outlet_name', 'address');
			},
			'user' => function ($q) {
				return $q->select('id', 'name');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name', 'user_id');
			},
		])
			->whereNotNull('item_id')
			->select('id', 'shop_id', 'user_id', 'item_id', 'depot_id', 'status', 'payment_modes', 'receive_amount', 'type', 'current_df', 'df_return_id')
			->find($id);

		if ($reqisition) {
			$item_id = $reqisition->item_id;
			$item = Item::with([
				'brand' => function ($b) {
					return $b->select('id', 'short_code');
				},
				'size' => function ($s) {
					return $s->select('id', 'name', 'installment');
				},
			])
				->select('brand_id', 'size_id', 'serial_no')
				->find($item_id);

			if ($reqisition->status != 'completed') {

				//if repace the old sattlement close then new sattlement create
				if ($reqisition->type == 'replace') {
					if ($returnObj = $this->settlementClose($reqisition)) {
						return $returnObj;
					}
				}
				$insertableData = $this->getSettlementDataForCreate($reqisition, $item);
				if (!empty($insertableData)) {

					//requistion_id already exits in settlements table
					try {
						$query = Settlement::create($insertableData);
					} catch (\Exception $e) {
						$query = true;
					}
					if ($query) {
						Requisition::where('id', $reqisition->id)->update(['status' => 'completed']);
						Item::where('id', $reqisition->item_id)->update(['item_status' => 'continue']);
						$message = "Successfully genarated gatepass. Please download it.";
						return redirect()->route('requisitions.index', 'completed')->with('flash_success', $message);
					} else {
						$message = "Something wrong!! Please try again.";
						return redirect()->route('requisitions.index', 'approved')->with('flash_danger', $message);
					}
				} else {
					$message = "This Df-size has no installment.";
					return redirect()->route('requisitions.index', 'approved')->with('flash_danger', $message);
				}
			}
			//https://packagist.org/packages/barryvdh/laravel-dompdf
			$pdf = \domPDF::loadView('pdf.gate_pass', compact('reqisition', 'item'));
			//return view('pdf.gate_pass', compact('reqisition', 'item'));
			return $pdf->download('gate_pass-' . $id . '.pdf');

		} else {
			$message = "Item is not assigned yet.";
			return redirect()->route('requisitions.index', 'approved')->with('flash_danger', $message);
		}
	}

	public function deedPapergenerate(Request $request, $id) {

		$reqisition = Requisition::with([
			'shop' => function ($q) {
				return $q->select('id', 'outlet_name', 'address', 'parmanent_address', 'present_address', 'mobile', 'proprietor_name');
			},
			'user' => function ($q) {
				return $q->select('id', 'name', 'designation_id');
			},
		])
			->whereNotNull('item_id')
			->where('status', 'completed')
			->select('id', 'shop_id', 'user_id', 'item_id', 'status', 'payment_modes', 'receive_amount', 'type', 'current_df', 'df_return_id')
			->find($id);

		$item_id = $reqisition->item_id;
		$item = Item::with([
			'brand' => function ($b) {
				return $b->select('id', 'short_code');
			},
			'size' => function ($s) {
				return $s->select('id', 'name', 'installment');
			},
		])
			->select('brand_id', 'size_id', 'serial_no', 'stock_detail_id')
			->find($item_id);

		$settlement = Settlement::where('item_id', $reqisition->item_id)
			->where('shop_id', $reqisition->shop_id)
			->where('requisition_id', $reqisition->id)->first();
		//dd($item->stock_detail_id);
		$orgins = Item::join('stock_details', 'stock_details.id', '=', 'items.stock_detail_id')
			->join('stocks', 'stocks.id', '=', 'stock_details.stock_id')
			->join('countries', 'countries.country_code', '=', 'stocks.origin')
			->select('countries.country_name')
			->where('items.stock_detail_id', $item->stock_detail_id)
			->where('items.id', $item_id)
			->first();

		//return view('requisitions.deedpaper', compact('reqisition', 'item', 'settlement'));

		$pdf = \mPDF::loadView('pdf.deedpaper', compact('reqisition', 'item', 'settlement', 'orgins'))->download('deedpaper' . time() . '.pdf');

	}

	public function approveAll(Request $request) {
		$data = $request->all();
		if (isset($data['ids'])) {
			$reqisitionStage = $data['stage'];
			$maxStageSeq = Stage::where('module', 'requisition')
				->max('sequence');

			$requisitionObj = Requisition::whereIn('id', $data['ids'])
				->select('id', 'payment_modes', 'action_by', 'stage_status', 'status', 'payment_verified')
				->get();
			//dd($requisitionObj->toArray());
			foreach ($requisitionObj as $currentRequisition) {
				/*if requision is full paid then application will final approve one stage before*/
				if ($currentRequisition->payment_modes == 'full_paid') {
					$currentMaxStageSeq = $maxStageSeq - 1;
				} else {
					$currentMaxStageSeq = $maxStageSeq;
				}

				if ($reqisitionStage < $currentMaxStageSeq) {
					$requisition = Requisition::where('id', $currentRequisition->id)
						->update([
							'action_by' => auth()->user()->id,
							'stage_status' => 'pending',
							'status' => 'processing',
							'stage' => $data['stage'] + 1,
						]);

				} else {
					$updateableArr = [
						'action_by' => auth()->user()->id,
						'stage_status' => 'approved',
						'status' => 'approved',
						'approved_at' => \Carbon\Carbon::now(),
					];
					if ($currentRequisition->payment_modes == 'without_rent') {
						$updateableArr['payment_verified'] = 'yes';
					}

					$requisition = Requisition::where('id', $currentRequisition->id)
						->update($updateableArr);
					//when the requisition final approved then send sms
					if ($requisition) {
						$requisitionSmsData = Requisition::requisitionApprovalSmsData($currentRequisition->id);
						$this->sendSms($requisitionSmsData, 'requisition_approve');
					}

				}
			}
			$message = "Requisitions approved successfully";
			return redirect()->route('requisitions.index', 'new')->with('flash_success', $message);
		} else {
			$message = "Please select at least one requisition.";
			return redirect()->route('requisitions.index', 'new')->with('flash_danger', $message);
		}
	}

}
