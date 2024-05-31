<?php

namespace App\Http\Controllers;

use App\Depot;
use App\DepotUser;
use App\Exports\DepotExport;
use App\Exports\HoldQtyExport;
use App\HoldStock;
use App\Location;
use App\Requisition;
use App\User;
use App\Zone;
use Illuminate\Http\Request;

class DepotsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$depots = Depot::with([
			'division' => function ($q) {
				return $q->select('id', 'name');
			},
			'district' => function ($q) {
				return $q->select('id', 'name');
			},
			'thana' => function ($q) {
				return $q->select('id', 'name');
			},
			'region' => function ($q) {
				return $q->select('id', 'name');
			},
			'area' => function ($q) {
				return $q->select('id', 'name');
			},
		])
			->orderByRaw('CAST(code AS SIGNED INTEGER) ASC')
			->get();
		return view('depots.index', compact('depots'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$divisions = Location::whereNull('parent_id')->pluck('name', 'id');
		$regions = Zone::whereNull('parent_id')->pluck('name', 'id');
		return view('depots.create', compact('divisions', 'regions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$data = $request->all();
		$request->validate([
			'division_id' => 'required',
			'district_id' => 'required',
			'thana_id' => 'required',
			'region_id' => 'required',
			'name' => 'required|max:50|unique:depots',
			'code' => 'required|max:2|unique:depots',
		]);

		$depots = Depot::create($data);
		if ($depots) {
			$message = "You have successfully created";
			return redirect()->route('depots.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('depots.index', [])
				->with('flash_danger', $message);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$depots = Depot::findOrFail($id);
		$divisions = Location::whereNull('parent_id')->pluck('name', 'id');
		$regions = Zone::whereNull('parent_id')->pluck('name', 'id');
		$districtObj = Location::where('parent_id', $depots->division_id)->pluck('name', 'id');
		$districts = json_encode($districtObj, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
		$thanaObj = Location::where('parent_id', $depots->district_id)->pluck('name', 'id');
		$thanas = json_encode($thanaObj, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
		$areaObj = zone::where('parent_id', $depots->region_id)->pluck('name', 'id');
		$areas = json_encode($areaObj, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
		$depotUserIds = DepotUser::where('depot_id', $id)->pluck('user_id');

		$depotUserObj = User::with(['designation' => function ($q) {
			return $q->select('id', 'short_name');
		}])
			->whereIn('id', $depotUserIds)
			->get();
		$depotUsers = [];
		foreach ($depotUserObj as $value) {
			$depotUsers[$value->id] = $value->name . '(' . $value->Designation->short_name . ')';
		}
		return view('depots.edit', compact('depots', 'divisions', 'districts', 'thanas', 'regions', 'areas', 'depotUsers'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$data = $request->except('_method', '_token');
		$validateArr = [
			'division_id' => 'required',
			'district_id' => 'required',
			'thana_id' => 'required',
			'region_id' => 'required',
			'name' => 'required|max:50|unique:depots,name,' . $id,
			'code' => 'required|max:2|unique:depots,code,' . $id,
		];
		if (array_key_exists('user_id', $data)) {
			$validateArr['user_id'] = 'required';
		} else {
			$data['user_id'] = NULL;
		}
		$request->validate($validateArr);
		if (!isset($data['has_incharge'])) {
			$data['has_incharge'] = false;
		}
		$depotObj = Depot::find($id);
		$oldHasIncharge = $depotObj->has_incharge;
		$depots = $depotObj->update($data);
		//$depots = true;
		if ($depots) {
			if ($oldHasIncharge && $data['has_incharge'] == false) {
				//if the updated depot change has incharge true to false then all requisitions goes first stage to second stage
				Requisition::where('depot_id', $id)
					->where('stage', 1)
					->update(['stage' => 2]);
			}
			$message = "You have successfully updated";
			return redirect()->route('depots.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Nothing changed!! Please try again";
			return redirect()->route('depots.index', [])
				->with('flash_warning', $message);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$msg = $this->checkUses($id, 'depot_id', 'DepotUser');
		if ($msg != 'no') {
			return $msg;
		}
		$depots = Depot::destroy($id);
		if ($depots) {
			$message = "You have successfully deleted";
			return redirect()->route('depots.index', [])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('depots.index', [])
				->with('flash_danger', $message);
		}
	}

	public function download() {
		return (new DepotExport())->download('Depots.xlsx');
	}

	public function holdDFQty(Request $request, $depotId = 3) {
		if ($request->isMethod('put')) {
			$data = $request->get('data');
			$filterData = array_filter($data, function ($var) {
				return $var['qty'] != null;
			});
			if (count($filterData)) {
				foreach ($filterData as $key => $value) {
					$newArr = array_chunk($value, 3, true);
					if ($newArr[1]['qty'] > 0) {
						HoldStock::updateOrInsert($newArr[0], $newArr[1]);
					} else {
						HoldStock::where($newArr[0])->delete();
					}
				}
				$message = "Successfully done.";
				return redirect()->route('depots.holdDFQty', $depotId)->with('flash_success', $message);
			} else {
				$message = "Please put minimum one hold quantity.";
				return redirect()->route('depots.holdDFQty', $depotId)->with('flash_danger', $message);
			}
		}
		$depot = new Depot();
		$availableDfs = $depot->availableDepotStocksForHold($depotId);
		$depots = $depot->pluck('name', 'id');
		$holdStocks = HoldStock::where('depot_id', $depotId)->select(\DB::raw("CONCAT(brand_id,'.',size_id) as idd"), 'qty')->pluck('qty', 'idd');
		return view('depots.hold_df_qty', compact('depots', 'availableDfs', 'depotId', 'holdStocks'));
	}

	public function HoldQtyDownload() {
		return (new HoldQtyExport())->download('hold-qty.xlsx');
	}
}
