<?php
namespace App\Traits;
use App\Allocation;
use App\DepotUser;
use App\DfCode;
use App\Item;
use App\Stock;
use App\StockTransfer;

trait AjaxForInventory {

	private function allocationDetailsById($id, $created = null) {
		return Allocation::with([
			'stock' => function ($q) {
				return $q->select('id', 'invoice_no', 'invoice_date');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			'allocation_details' => function ($q) use ($created) {
				return $q->with([
					'stock_detail' => function ($q) {
						return $q->with([
							'brand',
							'size' => function ($q) {
								return $q->select('id', 'name');
							},
						])
							->select('id', 'stock_id', 'brand_id', 'size_id');
					},
				])
					->where('item_created', '<>', $created)
					->select('id', 'allocation_id', 'stock_detail_id', 'qty', 'receive_qty', 'damage_qty', 'missing_qty', 'excess_qty');
			},

		])
			->find($id);
	}

	public function getStocks() {
		$query = Stock::select('id', 'supplier_id', 'invoice_no', 'lc_no', 'no_of_type', 'total_item', 'is_allocated', 'invoice_date')
			->selectRaw('IF (`is_allocated`=0,"Pending","Allocated") as status')
			->with(['supplier'])
			->orderBy('updated_at', 'desc')
			->get();
		return datatables($query)->make(true);
	}

	public function getStockDetails($id) {
		$stocks = Stock::with(['supplier', 'country', 'stock_details' => function ($q) {
			return $q->with([
				'brand' => function ($q) {
					return $q->select('id', 'short_code');
				},
				'size' => function ($q) {
					return $q->select('id', 'name');
				}]);
		}])
			->find($id);
		return view('ajax.stock_details', compact('stocks'));
	}

	public function getAllocationDetails($id) {
		$allocations = $this->allocationDetailsById($id);
		return view('ajax.allocation_details', compact('allocations'));
	}

	//depot wise allocated stock accept form
	public function depotStockAccept($id) {
		$allocations = $this->allocationDetailsById($id, 1);
		return view('ajax.allocation_receive', compact('allocations'));
	}

	public function getAllocations() {
		$query = Allocation::select('stock_id', 'created_at')
			->with([
				'stock' => function ($q) {
					return $q->select('id', 'invoice_no', 'is_allocated', 'invoice_date');
				},
			])
			->groupBy('stock_id', 'created_at')
			->orderBy('created_at', 'desc');
		return datatables()->of($query)->toJson();
	}

	public function getDepotAllocations($stockId = null) {
		$depotIds = DepotUser::where('user_id', auth()->user()->id)->pluck('depot_id');
		$allocationObj = Allocation::with([
			'stock' => function ($q) {
				return $q->select('id', 'invoice_no', 'is_allocated', 'invoice_date');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			// 'allocation_details' => function ($q) {
			//     return $q->where('item_created', 0)->select('allocation_id', 'id');
			// },
		]);

		if ($stockId) {
			$allocationObj->where('stock_id', $stockId);
		}
		$allocationObj->whereIn('depot_id', $depotIds)
			->orderBy('allocations.updated_at', 'desc');
		return datatables()->of($allocationObj)->toJson();
	}

	public function getItems($param = 'with_serial_dF') {

		$isExecutiveGroup = \App\Role::where('id', auth()->user()->role_id)->value('can_apply');

		$query = Item::with([
			'size' => function ($q) {
				return $q->select('id', 'name');
			},
			'brand',
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
		])
			->select('items.id', 'items.size_id', 'items.brand_id', 'items.depot_id', 'items.shop_id', 'items.serial_no', 'items.item_status', 'items.freeze_status', 'items.created_at', 'shops.outlet_name as outlet_name')
			->selectRaw("CASE
					WHEN(items.freeze_status='damage_applied') THEN 'Damage Applied'
					WHEN(items.freeze_status='low_cooling') THEN 'Low Cooling'
					WHEN(items.freeze_status='fresh') THEN 'Fresh'
					WHEN(items.freeze_status='used') THEN 'Used'
					WHEN(items.freeze_status='damage') THEN 'Damage'
					WHEN(items.freeze_status='support') THEN 'Support'
					ELSE items.freeze_status
					END as freeze_status_custom"
			);

		if (!$isExecutiveGroup) {
			$query->join('depot_users', 'depot_users.depot_id', '=', 'items.depot_id')
				->leftJoin('shops', function ($join) {
					$join->on('shops.id', '=', 'items.shop_id');
					$join->whereNotNull('items.item_status');
				})
				->where('depot_users.user_id', auth()->user()->id);
		} else {
			$query->join('shops', function ($join) {
				$join->on('shops.id', '=', 'items.shop_id');
				$join->whereNotNull('items.item_status');
			})
				->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
				->where('distributor_users.user_id', auth()->user()->id);
		}

		if ($param == 'without_serial_dF') {
			$query->whereNull('items.serial_no');
		} elseif ($param == 'with_serial_dF') {
			$query->whereNotNull('items.serial_no')->whereNull('items.item_status')->whereIn('items.freeze_status', ['used', 'fresh']);
		} elseif ($param == 'injected_dF') {
			$query->whereNotNull('items.serial_no')->whereNotNull('items.shop_id')->whereNotNull('items.item_status')->whereIn('items.freeze_status', ['used', 'damage_applied', 'low_cooling']);
		} elseif ($param == 'support_dF') {
			$query->whereNotNull('items.serial_no')->where('items.freeze_status', 'support');
		} elseif ($param == 'low_cooling_dF') {
			$query->whereNotNull('items.serial_no')->where('items.freeze_status', 'low_cooling');
		} elseif ($param == 'in_sip_dF') {
			$query->whereNotNull('items.serial_no')->whereIn('items.freeze_status', ['used', 'low_cooling'])->where('items.item_status', 'in_sip');
		} elseif ($param == 'damage_dF') {
			$query->where('items.freeze_status', 'damage')
				->orderBy('items.shop_id', 'desc');
		} else {
			$query->whereNull('items.freeze_status');
		}
		$query->orderBy('items.updated_at', 'desc');
		return datatables($query)->make(true);
		//return datatables()->of($query)->toJson();
		// return datatables()->of(DB::table('users'))->toJson();
		// return datatables()->of(User::all())->toJson();
	}

	/**
	 * Show the stock transfer receive from for the given user.
	 *
	 * @param  int  $stock_transfer_id
	 * @return Response
	 */

	public function stockTransferShow($stock_transfer_id) {

		$transferData = (new StockTransfer)->findStockTransfer($stock_transfer_id);

		return view('ajax.stock_transfer_show', compact('transferData'));
	}

	/**
	 * Show the stock transfer receive from for the given user.
	 *
	 * @param  int  $stock_transfer_id
	 * @return Response
	 */

	public function stockTransferEdit($from_depot, $transfer_id) {

		$stockTransfer = (new StockTransfer)->findStockTransfer($transfer_id);

		$transferData = (new StockTransfer)->stockTransferEditableData($from_depot, $transfer_id);

		return view('ajax.stock_transfer_edit', compact('stockTransfer', 'transferData', 'placedData'));
	}

	public function dfcodeLists() {
		$query = DfCode::select('df_codes.*', 'users.name as user_name')
			->leftJoin('users', 'users.id', '=', 'df_codes.user_id')
			->orderBy('post_code', 'desc');
		return datatables($query)->make(true);
	}
}

?>