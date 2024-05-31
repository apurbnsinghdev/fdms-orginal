<?php

namespace App\Http\Controllers;
use App\Allocation;
use App\AllocationDetail;
use App\Brand;
use App\Country;
use App\Depot;
use App\DfCode;
use App\DfProblem;
use App\Exports\AllocationExport;
use App\Exports\DFCodeExport;
use App\Exports\ItemsExport;
use App\Item;
use App\Size;
use App\Stock;
use App\StockDetail;
use App\Supplier;
use App\Traits\StockTransferTrait;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoriesControler extends Controller {
	use StockTransferTrait;

	public function stockCreate(Request $request) {
		if ($request->isMethod('post')) {
			return $this->stockStore($request);
		} else {
			$suppliers = Supplier::pluck('name', 'id');
			$brands = Brand::select(DB::raw("CONCAT(name,'(',short_code,')') AS name"), 'id')->pluck('name', 'id');
			if (!count($brands)) {
				$brands = '{}';
			}
			$sizes = Size::where('availability', 'yes')->pluck('id', 'name'); //vue js default order by its key
			if (!count($sizes)) {
				$sizes = '{}';
			}
			$countries = Country::pluck('country_name', 'country_code');

			return view('inventories.stock_create', compact('suppliers', 'brands', 'sizes', 'countries'));
		}
	}

	private function stockStore($request) {
		$data = $request->except('details');
		$data['invoice_date'] = Carbon::parse($data['invoice_date'])->format('Y-m-d');
		$stockDetailsData = $request->only('details');
		//dd($stockDetailsData);
		$request->validate([
			'invoice_no' => 'required|unique:stocks',
			'lc_no' => 'nullable|unique:stocks',
			'details.*.brand_id' => 'required',
			'details.*.size_id' => 'required',
			'details.*.qty' => 'required',
			'details.*.unit_price' => 'nullable|numeric|between:0,999999.99',
		]);

		//insert data in stock
		$stocks = Stock::create($data);
		//insert data in stockDetails
		$stockDetails = $stocks->stock_details()->createMany($stockDetailsData['details']);
		if ($stockDetails) {
			$no_of_type = $stockDetails->count();
			$total_item = $stockDetails->sum('qty');
			$stocks->update(['no_of_type' => $no_of_type, 'total_item' => $total_item]);
			$message = "You have successfully created";
			return redirect()->route('inventories.stockIndex')
				->with('flash_success', $message);
		}

	}

	public function stockIndex() {
		return view('inventories.stock_index');
	}

	public function stockEdit(Request $request, $id) {
		if ($request->isMethod('put')) {
			return $this->stockUpdate($request, $id);
		} else {
			$stocks = Stock::with(['stock_details'])
				->findOrFail($id);

			$suppliers = Supplier::pluck('name', 'id');
			$brands = Brand::pluck('name', 'id');
			if (!count($brands)) {
				$brands = '{}';
			}
			$sizes = Size::where('availability', 'yes')->pluck('id', 'name'); //vue js default order by its key
			if (!count($sizes)) {
				$sizes = '{}';
			}
			$countries = Country::pluck('country_name', 'country_code');

			return view('inventories.stock_edit', compact('stocks', 'suppliers', 'brands', 'sizes', 'countries'));
		}
	}

	private function stockUpdate($request, $id) {
		$data = $request->except('_token', '_method', 'details');
		$stockDetailsData = $request->only('details');
		if ($stockDetailsData) {
			$request->validate([
				'invoice_no' => 'required|unique:stocks,invoice_no,' . $id,
				'lc_no' => 'nullable|unique:stocks,lc_no,' . $id,
				'details.*.brand_id' => 'required',
				'details.*.size_id' => 'required',
				'details.*.qty' => 'required',
				'details.*.unit_price' => 'nullable|numeric|between:0,999999.99',
			]);

			//existing db row for stockDetails
			$dbStockDetailsIds = StockDetail::where('stock_id', $id)->pluck('id');
			//form request stock detail ids
			$formDetailIds = collect($stockDetailsData['details'])->pluck('id');
			//deletable stock detail ids
			$stockDetailDeleteableIds = $dbStockDetailsIds->diff($formDetailIds);
			if ($stockDetailDeleteableIds->count() > 0) {
				StockDetail::destroy($stockDetailDeleteableIds);
			}

			$formStockDetailsIds = []; //input row for stockDetails
			$totalItem = 0;
			//update or create stockDetails
			foreach ($stockDetailsData['details'] as $value) {
				if ($value['brand_id'] == "null") {
					unset($value['brand_id']);
				}
				if (!empty($value['id'])) {
					$detailId = $value['id'];
					$formStockDetailsIds[] = $detailId;
					unset($value['id']);
					StockDetail::where('id', $detailId)->update($value);
				} else {
					$value['stock_id'] = $id;
					StockDetail::create($value);
				}
				$totalItem += $value['qty'];
			}
			$data['no_of_type'] = count($stockDetailsData['details']);
			$data['total_item'] = $totalItem;

		} else {
			$request->validate([
				'invoice_no' => 'required|unique:stocks,invoice_no,' . $id,
				'lc_no' => 'nullable|unique:stocks,lc_no,' . $id,
			]);
		}
		//update stocks
		$stocks = Stock::where('id', $id)->update($data);
		$message = "You have successfully updated";
		return redirect()->route('inventories.stockIndex')
			->with('flash_success', $message);
	}

	public function stockDestroy($id) {
		$stock = Stock::find($id);
		$stocks = $stock->delete();
		if ($stocks) {
			$message = "You have successfully deleted";
			return redirect()->route('inventories.stockIndex')
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('inventories.stockIndex')
				->with('flash_danger', $message);
		}
	}

	/*Invoice wise new stock allocate for multiple depot*/
	public function stockAllocate(Request $request, $id) {
		if ($request->isMethod('post')) {
			return $this->stockAllocateStore($request, $id);
		} else {
			$depots = Depot::pluck('name', 'id');
			$stock = Stock::select('id')->with(['stock_details' => function ($q) {
				return $q->select('id', 'stock_id', 'brand_id', 'size_id', 'qty')->with([
					'brand',
					'size' => function ($q) {
						return $q->select('id', 'name');
					},
				]);
			}])->find($id);
			return view('inventories.stock_allocate', compact('depots', 'stock'));
		}
	}

	//data insert in allocation and allocationDetails
	private function insertStockAllocateData($data, $id) {
		$created_at = \Carbon\Carbon::now();
		foreach ($data['data'] as $value) {
			$totStockDetailAllocate = 0;
			$allocateData = [];
			$allocateData['stock_id'] = $id;
			$allocateData['depot_id'] = $value['depot_id'];
			$allocateData['status'] = 'pending';
			$allocateData['created_at'] = $created_at;
			$i = 0;
			$allocateDetailData = [];
			foreach ($value['details'] as $key => $val) {
				if ($val) {
					$allocateDetailData[$i]['stock_detail_id'] = $key;
					$allocateDetailData[$i]['qty'] = $val;
					$totStockDetailAllocate += $val;
					$i++;
				}
			}
			//dd($detailObj->diff(collect($value['details'])));
			if (!empty($allocateDetailData)) {
				//allocate create for every depot
				$allocateObj = Allocation::create($allocateData);
				//allocation detail create under allocation
				$allocationDetails = $allocateObj->allocation_details()->createMany($allocateDetailData);
				//update allocation
				$allocateObj->update(['no_of_item' => count($allocateDetailData), 'total_qty' => $totStockDetailAllocate]);
			}

		}
		//update stock
		Stock::where('id', $id)->update(['is_allocated' => true]);
	}

	private function compareAllocatedItemValue($data, $id) {
		$dbDetailObj = StockDetail::where('stock_id', $id)->pluck('qty', 'id')->toArray();
		$requestDetailObj = collect(array_column($data['data'], 'details'));
		$compareAbleObj = [];
		foreach ($dbDetailObj as $key => $value) {
			$compareAbleObj[$key] = $requestDetailObj->sum($key);
		}
		$comparedResultArray = array_diff_assoc($dbDetailObj, $compareAbleObj);

		if (count($comparedResultArray) > 0) {
			return true;
		} else {
			return false;
		}

	}

	private function stockAllocateStore($request, $id) {
		$data = $request->except('_token');

		if ($this->compareAllocatedItemValue($data, $id)) {
			$message = "Every item value must be same! Please check again.";
			return redirect()->route('inventories.stockAllocate', [$id])
				->with('flash_danger', $message)->withInput();
		} else {
			$this->insertStockAllocateData($data, $id);
			$message = "You have successfully allocated";
			return redirect()->route('inventories.stockIndex')
				->with('flash_success', $message);
		}
	}

	private function getReceivedDepotLists($collection) {
		$deputIds = [];
		foreach ($collection as $key => $value) {
			if (!$value->allocation_details->count()) {
				$deputIds[] = $value->depot_id;
			}
		}
		return $deputIds;
	}

	/*Invoice wise allocated stock for multiple depot edit*/
	public function allocatedStockEdit(Request $request, $id) {
		if ($request->isMethod('put')) {
			return $this->allocatedStockUpdate($request, $id);
		} else {
			$stock = Stock::select('id')->with(['stock_details' => function ($q) {
				return $q->select('id', 'stock_id', 'brand_id', 'size_id', 'qty')->with([
					'brand',
					'size' => function ($q) {
						return $q->select('id', 'name');
					},
				]);
			}])->find($id);

			$allocations = Allocation::with([
				'allocation_details' => function ($q) {
					return $q->select('id', 'allocation_id', 'stock_detail_id', 'qty');
				},
			])
				->select("id", "depot_id") //"stock_id", "no_of_item", "total_qty"
				->where('stock_id', $id)
				->get();

			// $receivedDepotIds = $this->getReceivedDepotLists($allocations);
			// if (count($receivedDepotIds)) {
			//     $depots = Depot::whereNotIn('id', $receivedDepotIds)->pluck('name', 'id');
			// } else {
			//     $depots = Depot::pluck('name', 'id');
			// }

			$depots = Depot::pluck('name', 'id');

			return view('inventories.allocated_stock_edit', compact('depots', 'stock', 'allocations'));
		}
	}

	private function allocatedStockUpdate($request, $id) {
		$data = $request->except('_token');
		if ($this->compareAllocatedItemValue($data, $id)) {
			$message = "Every item value must be same! Please check again.";
			return redirect()->route('inventories.allocatedStockEdit', [$id])
				->with('flash_danger', $message)->withInput();
		} else {
			//delete first
			$this->allocationDeleteByStockId($id);
			//then insert
			$this->insertStockAllocateData($data, $id);
			$message = "You have successfully updated";
			return redirect()->route('inventories.allocatedStockIndex')
				->with('flash_success', $message);
		}

	}

	/*Invoice wise allocated stock for multiple depot lists*/
	public function allocatedStockIndex() {
		return view('inventories.allocated_stock_index');
	}

	/*Invoice wise allocated stock for multiple depot delete*/
	public function allocatedStockDelete($id) {
		$allocations = $this->allocationDeleteByStockId($id);
		if ($allocations) {
			//update is_allocated in stock
			Stock::where('id', $id)->update(['is_allocated' => 0]);
			$message = "You have successfully deleted";
			return redirect()->route('inventories.allocatedStockIndex')
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('inventories.allocatedStockIndex')
				->with('flash_danger', $message);
		}
	}

	//delete allocation and allocationDetails data
	private function allocationDeleteByStockId($stockId) {
		$allocation = Allocation::where('stock_id', $stockId)->get();
		foreach ($allocation as $value) {
			$value->delete();
		}
		if ($allocation) {
			return true;
		}
	}
	/*
		    1.Invoice wise allocated stock for single depot lists (for admin)
		    2.Depot wise all Invoice's allocated stock lists (every depot user)
	*/
	public function depotAllocatedStockIndex($stockId = null) {
		$stock = null;
		if ($stockId) {
			$stock = Stock::select('id', 'is_allocated')->find($stockId);
		}
		return view('inventories.depot_allocated_stock_index', compact('stock'));
	}

	public function allocationPrint($id) {
		if ($id) {
			return Excel::download(new AllocationExport($id), 'allocation.xlsx');
		}
	}

	public function allocationApprove(Request $request, $id) {
		if (!empty($id)) {
			Stock::where('id', $id)->update(['is_allocated' => 2]);
			$message = "You have successfully approved";
			return redirect()->route('inventories.depotAllocatedStockIndex', $id)
				->with('flash_success', $message);
		} else {
			$message = "Something is wrong!";
			return redirect()->route('inventories.depotAllocatedStockIndex')
				->with('flash_danger', $message);
		}
	}

	public function allocatedStockReceive(Request $request) {
		$data = $request->except('_token', 'invoice_date');
		$messagetype = 'flash_warning';
		$message = "Opps! No data updated.";
		$created_at = $request->get('invoice_date');
		$updated_at = \Carbon\Carbon::now();
		$allocationId = 0;
		if (!empty($data['data'])) {
			foreach ($data['data'] as $value) {
				$allocationDetailObj = AllocationDetail::find($value['id']);
				$allocationId = $allocationDetailObj->allocation_id;

				$itemData = [];
				//item create from receive quantity
				$createAbleItemReqest = [];
				if ($value['receive_qty']) {
					$createAbleItemReqest['receive_qty'] = $value['receive_qty'];
				}
				if ($value['excess_qty']) {
					$createAbleItemReqest['excess_qty'] = $value['excess_qty'];
				}
				if ($value['damage_qty']) {
					$createAbleItemReqest['damage_qty'] = $value['damage_qty'];
				}
				$counter = 0;
				if (!empty($createAbleItemReqest) && empty($allocationDetailObj->item_created)) {
					foreach ($createAbleItemReqest as $ky => $vl) {
						$totalItemData = count($itemData);
						$counter += $vl;
						if ($ky !== 'damage_qty') {
							$frezeStatus = 'fresh';
						} else {
							$frezeStatus = 'damage';
						}
						for ($i = $totalItemData; $i < $counter; $i++) {
							$itemData[$i]['stock_detail_id'] = $value['stock_detail_id'];
							if (isset($value['brand_id'])) {
								$itemData[$i]['brand_id'] = $value['brand_id'];
							}
							$itemData[$i]['size_id'] = $value['size_id'];
							$itemData[$i]['depot_id'] = $value['depot_id'];
							$itemData[$i]['allocation_detail_id'] = $value['id'];
							$itemData[$i]['freeze_status'] = $frezeStatus;
							$itemData[$i]['longevity_period'] = '7 year';
							$itemData[$i]['created_at'] = $created_at;
							$itemData[$i]['updated_at'] = $updated_at;
						}
					}
					$query = Item::insert($itemData);
					if ($query) {
						//update allocationDetails
						$allocationDetailObj->receive_qty = $value['receive_qty'] ?: 0;
						$allocationDetailObj->damage_qty = $value['damage_qty'] ?: 0;
						$allocationDetailObj->missing_qty = $value['missing_qty'] ?: 0;
						$allocationDetailObj->excess_qty = $value['excess_qty'] ?: 0;
						$allocationDetailObj->comments = $value['comments'];
						$allocationDetailObj->item_created = 1;
						$allocationDetailObj->save();

						//update stockDetails
						$receiveQty = $allocationDetailObj->receive_qty + (int) $allocationDetailObj->excess_qty;
						StockDetail::where('id', $value['stock_detail_id'])
							->update(['receive_qty' => DB::raw('receive_qty + ' . $receiveQty)]);
						$messagetype = 'flash_success';
						$message = "You have successfully received";
					} else {
						$messagetype = 'flash_danger';
						$message = "Something missing!! Please try again";
					}
				}
			}

			$countVal = AllocationDetail::where('allocation_id', $allocationId)->where('item_created', 0)->count();
			if (!$countVal) {
				$allocationObj = Allocation::find($allocationId);
				$allocationObj->status = 'receive';
				$allocationObj->save();
			}
		}
		return redirect()->route('inventories.depotAllocatedStockIndex')
			->with($messagetype, $message);
	}

	public function itemIndex($param = '') {

		$isExecutiveGroup = \App\Role::where('id', auth()->user()->role_id)->value('can_apply');
		if ($param == '' AND $isExecutiveGroup) {
			$param = 'injected_dF';

		} elseif ($param == '' AND !$isExecutiveGroup) {
			$param = 'with_serial_dF';
		} else {
			$param = $param;
		}

		return view('inventories.item_index', compact('param', 'isExecutiveGroup'));
	}

	//add or edit item serial
	public function inputItemSerial(Request $request) {
		if (!empty($request['requestFrom'])) {
			$validator = \Validator::make($request->toArray(), [
				'serial' => 'required|between:3,8',
			]);

			if ($validator->fails()) {
				return response()->json([
					'error' => true,
					'success' => true,
					'message' => 'The serial can not be blank and must be 3 to 8 characters.',
				]);
			}
			$request['serial'] = $request['preSerial'] . $request['serial'];
			$validator = \Validator::make($request->toArray(), [
				'serial' => 'unique:items,serial_no,' . $request['item_id'],
			]);

			if ($validator->fails()) {
				return response()->json([
					'error' => true,
					'success' => true,
					'message' => 'The serial has already been taken.',
				]);
			}
		} else {
			$request->validate([
				'serial' => 'required|between:3,8',
			]);
			$request['serial'] = $request['preSerial'] . $request['serial'];
			$request->validate([
				'serial' => 'unique:items,serial_no,' . $request['item_id'],
			]);
		}
		$item = Item::find($request['item_id']);
		$item->serial_no = $request['serial'];
		$item->save();
		return $item;
	}
	//return support df
	public function returnSupportDf(Request $request) {
		$data = $request->all();
		//dd($data);
		$item = Item::itemUpdate(['item_status' => null], ['id' => $data['id']]);
		if ($item) {
			DfProblem::where('item_id', $data['id'])
				->update(['item_id' => null, 'support' => 3]);

			$message = "Item status successfully updated.";
			return redirect()->back()
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->back()
				->with('flash_danger', $message);
		}
	}
	//change item status (used,support,low_cooling)
	public function changeItemStatus(Request $request) {
		$data = $request->all();
		$changeArr = ['support', 'low_cooling'];
		if (in_array($data['freeze_status'], $changeArr)) {
			$item = Item::itemUpdate(['freeze_status' => $data['freeze_status']], ['id' => $data['id']]);
		} else {
			$item = false;
		}

		if ($item) {
			$message = "Item status successfully updated.";
			return redirect()->back()->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->back()->with('flash_danger', $message);
		}
	}

	private function itemExportForPolar() {
		ini_set('memory_limit', '256M');
		$depots = Depot::pluck('name', 'id');
		foreach ($depots as $id => $name) {
			Excel::store(new \App\Exports\ItemExport($id), 'df_lists_' . $name . '.xlsx');
		}
		dd('allDone');
	}

	public function itemExport($param = 'with_serial_dF') {
		/*
			        ===========Start code============
			        Excel files, depot wise df lists, store to "\storage\app\public\"
		*/
		//$this->itemExportForPolar();
		/*==========End Code==========*/

		if ($param == 'without_serial_dF') {
			$filename = 'Item (without serial).xlsx';
		} else if ($param == 'with_serial_dF') {
			$filename = 'Item (with serial).xlsx';
		} elseif ($param == 'injected_dF') {
			$filename = 'Item (injected).xlsx';
		} elseif ($param == 'support_dF') {
			$filename = 'Item (support).xlsx';
		} elseif ($param == 'low_cooling_dF') {
			$filename = 'Item (low cooling).xlsx';
		} elseif ($param == 'in_sip_dF') {
			$filename = 'Item (In SIP).xlsx';
		} elseif ($param == 'damage_dF') {
			$filename = 'Item (damage).xlsx';
		}

		return Excel::download(new ItemsExport($param), $filename);
	}

	public function generateDFCode(Request $request) {
		$max = DfCode::max('post_code');
		if ($request->isMethod('post')) {
			$data = $request->all();
			$userId = auth()->id();
			$validateArr = [
				'brand' => 'required',
				'size' => 'required',
				'year' => 'required',
				'qty' => 'required',
			];

			if ($request->has('initial_qty')) {
				$validateArr['initial_qty'] = 'required|numeric';
				$startVaue = $data['initial_qty'];
			} else {
				$startVaue = $max + 1;
			}
			$request->validate($validateArr);

			$rangeArr = range($startVaue, $startVaue + $data['qty'] - 1);

			//dd($rangeArr);

			$saveArr = [];
			foreach ($rangeArr as $key => $value) {
				$saveArr[$key]['brand'] = $data['brand'];
				$saveArr[$key]['size'] = $data['size'];
				$saveArr[$key]['year'] = $data['year'];
				$saveArr[$key]['user_id'] = $userId;
				$saveArr[$key]['post_code'] = $value;
				$saveArr[$key]['serial_no'] = 'DIIL/' . $data['brand'] . '/' . $data['size'] . '/' . substr($data['year'], -2) . str_pad($value, 6, '0', STR_PAD_LEFT);
			}

			$result = DfCode::insert($saveArr);
			if ($result) {
				return redirect()->route('inventories.generateDFCode')->with('flash_success', 'You have successfully created.');
			} else {
				return redirect()->route('inventories.generateDFCode')->with('flash_danger', 'Something wrong !! Please try again.');
			}
		}

		$sizes = Size::where('availability', 'yes')
			->orderBy('name', 'asc')
			->pluck('name', 'name');

		$brands = Brand::select('short_code')
			->selectRaw("CONCAT(name,'(',short_code,')') as name")
			->pluck('name', 'short_code');

		$years = DfCode::distinct()->pluck('year', 'year');

		return view('inventories.generated_df_code_lists', compact('max', 'brands', 'sizes', 'years'));
	}

	public function downloadDFCode(Request $request) {
		$year = $request->get('year');
		return Excel::download(new DFCodeExport($year), "DFCode($year).xlsx");
	}

}