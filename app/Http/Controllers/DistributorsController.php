<?php

namespace App\Http\Controllers;

use App\Depot;
use App\DepotUser;
use App\DistributorUser;
use App\Document;
use App\Exports\DistributorsExport;
use App\Location;
use App\Shop;
use App\ShopDetail;
use App\Traits\DocumentsUpload;
use App\Zone;
use DB;
use Illuminate\Http\Request;

class DistributorsController extends Controller {
	use DocumentsUpload;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('distributors.index');
	}

	/**
	 * Display a listing of the resource for distrtibutor shops.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function distributorShopList($param) {
		//dd($param);
		if (!DistributorUser::where('distributor_id', $param)->where('user_id', auth()->user()->id)->exists()) {
			return redirect()->back()->with('flash_danger', 'You are not allowed to view this page');

		}
		$distributor = Shop::with('retailers')->select('id', 'distributor_id', 'outlet_name', 'depot_id')->find($param);
		//dd($shops->toArray());
		return view('distributors.distributor_shop_list', compact('distributor'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$divisions = Location::whereNull('parent_id')->pluck('name', 'id');
		$authUserId = auth()->user()->id;
		$depotUsers = DepotUser::where('user_id', $authUserId)->select('depot_id')->get();

		$depotId = 0;
		$depots = collect([]);
		$depotIds = collect([]);

		$regionId = 0;
		$regions = collect([]);
		$areas = collect([]);

		if (count($depotUsers) == 1) {
			$depotId = $depotUsers[0]->depot_id;
			$regionId = Depot::where('id', $depotId)->pluck('region_id')[0];
			$regions = Zone::find($regionId);
			$areas = Zone::where('parent_id', $regionId)->pluck('name', 'id');
		} elseif (count($depotUsers) > 1) {
			$depotIds = $depotUsers->pluck('depot_id');
			$depotObj = Depot::whereIn('id', $depotIds)->select('id', 'name', 'region_id')->get();
			$regionIds = $depotObj->pluck('region_id', 'region_id');
			if ($regionIds->count() == 1) {
				$regionId = $regionIds->values()[0];
				$regions = Zone::find($regionId);
				$areas = Zone::where('parent_id', $regionId)->pluck('name', 'id');
			} else if ($regionIds->count() > 1) {
				$regions = Zone::whereIn('id', $regionIds)->pluck('name', 'id');
			}
			$depots = $depotObj->pluck('name', 'id');
		}

		$authUserDistibutorIds = DistributorUser::where('user_id', $authUserId)->pluck('distributor_id');
		$distributors = Shop::whereIn('id', $authUserDistibutorIds)
			->where('status', 'active')
			->pluck('outlet_name', 'id');

		return view('distributors.create', compact('divisions', 'regionId', 'regions', 'areas', 'depotId', 'depots', 'distributors'));
	}

	private function makeCode($regionId, $depotId, $id = null) {
		$regionCode = Zone::where('id', $regionId)->value('code') ?: '00';
		$depotCode = Depot::where('id', $depotId)->value('code') ?: '00';
		return $regionCode . $depotCode;
		if ($id) {
			if (!$x = Shop::where('id', $id)->value('pre_code')) {
				$preCode = Shop::where('is_distributor', 1)->max('pre_code') + 1;
			} else {
				$preCode = $x;
			}
		} else {
			$preCode = Shop::where('is_distributor', 1)->max('pre_code') + 1;
		}
		$data['pre_code'] = str_pad($preCode, 4, 0, STR_PAD_LEFT);
		$data['code'] = $regionCode . $depotCode . $data['pre_code'];
		return $data;
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$data = $request->all();
		$data['outlet_name'] = str_replace(',', '.', $data['outlet_name']);
		$redirectArr = [];
		$generate_code = 0;
		if (!empty($data['region_id']) && (!empty($data['depot_id']))) {
			$generate_code = $this->makeCode($data['region_id'], $data['depot_id']);
		}

		$validatorArr = [
			'outlet_name' => 'required',
			'proprietor_name' => 'required',
			'mobile' => 'required|digits:11|unique:shops,mobile,NULL,id,outlet_name,' . $data['outlet_name'],
			'nid' => 'nullable',
			'depot_id' => 'required',
			'division_id' => 'required',
			'district_id' => 'required',
			'thana_id' => 'required',
			'region_id' => 'required',
			'address' => 'nullable|max:255',
			'estimated_sales' => 'nullable|numeric|between:0,999999999',
			'permanent_address' => 'required|max:255',
			'present_address' => 'required|max:255',
			'birthday' => 'nullable|date',
			'spouse_name' => 'nullable|max:64',
			'father_name' => 'nullable|max:100',
			'mother_name' => 'nullable|max:100',
			'son' => 'nullable|numeric',
			'daughter' => 'nullable|numeric',
			'business_startday' => 'nullable|date',
			'marriage_day' => 'nullable|date',
			'spouse_birthday' => 'nullable|date',
			'code' => ['required', 'size:4', function ($attribute, $value, $fail) use ($data, $generate_code) {
				$distributor_code = $generate_code . $data['code'];
				$shopCount = Shop::where('code', $distributor_code)->count();
				if ($shopCount > 0) {
					$fail(':attribute is already taken!');
				}
			}],
		];

		$redirectAdress = 'distributors.index';

		$fieldsArr = [];
		foreach (config('myconfig.shop_file') as $k => $v) {
			$validatorArr[$v] = 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024';
			$filesInfo = $request->file($v);
			if ($filesInfo) {
				$fieldsArr[$v] = $filesInfo;
				unset($data[$v]);
			}
		}

		$request->validate($validatorArr);
		$shopData = [
			'is_distributor' => 1,
			'outlet_name' => $data['outlet_name'],
			'proprietor_name' => $data['proprietor_name'],
			'mobile' => $data['mobile'],
			'nid' => $data['nid'],
			'category' => $data['category'],
			'estimated_sales' => $data['estimated_sales'],
			'trade_license' => $data['trade_license'],
			'address' => $data['address'],
			'division_id' => $data['division_id'],
			'district_id' => $data['district_id'],
			'thana_id' => $data['thana_id'],
			'region_id' => $data['region_id'],
			'area_id' => $data['area_id'],
			'depot_id' => $data['depot_id'],
			'parmanent_address' => $data['permanent_address'],
			'present_address' => $data['present_address'],
		];

		//$codeArr = $generate_code;
		$shopData['pre_code'] = $data['code'];
		$shopData['code'] = $generate_code . $data['code'];

		$shopDetailsData = [
			'birthday' => $data['birthday'],
			'spouse_name' => $data['spouse_name'],
			'father_name' => $data['father_name'],
			'mother_name' => $data['mother_name'],
			'son' => $data['son'],
			'daughter' => $data['daughter'],
			'business_startday' => $data['business_startday'],
			'marriage_day' => $data['marriage_day'],
			'spouse_birthday' => $data['spouse_birthday'],
		];
		$shops = Shop::create($shopData);
		if ($shops) {

			$shopDetails = new ShopDetail($shopDetailsData);
			$shops->detail()->save($shopDetails);

			//add permission for newly created distributor
			DistributorUser::create([
				'distributor_id' => $shops->id,
				'user_id' => auth()->user()->id,
			]);

			//document upload
			if (count($fieldsArr)) {
				$this->storeDucuments($fieldsArr, $shops);
			}
			$message = "You have successfully created Distributor";

			return redirect()->route($redirectAdress, $redirectArr)
				->with('flash_success', $message);

		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('distributor.index', $redirectArr)
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
		$shops = Shop::findOrFail($id);
		$divisions = Location::whereNull('parent_id')->pluck('name', 'id');
		$districts = Location::where('parent_id', $shops->division_id)->pluck('name', 'id');
		$thanas = Location::where('parent_id', $shops->district_id)->pluck('name', 'id');
		$areas = zone::where('parent_id', $shops->region_id)->pluck('name', 'id');
		$authUserId = auth()->user()->id;

		$depotUsers = DepotUser::where('user_id', $authUserId)->select('depot_id')->get();
		$documents = Document::where('shop_id', $id)
			->whereNull('module')
			->pluck('file_name', 'field_name');

		$depotId = 0;
		$depots = collect([]);
		$depotIds = collect([]);

		$regionId = 0;
		$regions = collect([]);

		if (count($depotUsers) == 1) {
			$depotId = $depotUsers[0]->depot_id;
			$regionId = Depot::where('id', $depotId)->pluck('region_id')[0];
			$regions = Zone::find($regionId);
		} elseif (count($depotUsers) > 1) {
			$depotIds = $depotUsers->pluck('depot_id');
			$depotObj = Depot::whereIn('id', $depotIds)->select('id', 'name', 'region_id')->get();
			$regionIds = $depotObj->pluck('region_id', 'region_id');
			if ($regionIds->count() == 1) {
				$regionId = $regionIds->values()[0];
				$regions = Zone::find($regionId);
			} else if ($regionIds->count() > 1) {
				$regions = Zone::whereIn('id', $regionIds)->pluck('name', 'id');
			}
			$depots = $depotObj->pluck('name', 'id');
		}

		$authUserDistibutorIds = DistributorUser::where('user_id', $authUserId)->pluck('distributor_id');
		$distributors = Shop::whereIn('id', $authUserDistibutorIds)
			->where('depot_id', $shops->depot_id)
			->where('status', 'active')
			->pluck('outlet_name', 'id');
		return view('distributors.edit', compact('shops', 'divisions', 'districts', 'thanas', 'areas', 'regionId', 'regions', 'depots', 'distributors', 'depotId', 'documents'));
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
		$data['outlet_name'] = str_replace(',', '.', $data['outlet_name']);
		$redirectArr = [];
		$redirectArr = [1];
		$generate_code = 0;
		if (!empty($data['region_id']) && (!empty($data['depot_id']))) {
			$generate_code = $this->makeCode($data['region_id'], $data['depot_id']);
		}

		$validatorArr = [
			'outlet_name' => 'required',
			'proprietor_name' => 'required',
			//'mobile' => 'required|digits:11|unique:shops,id,' . $id,
			'mobile' => 'required|digits:11|unique:shops,mobile,' . $id . ',id,outlet_name,' . $data['outlet_name'],
			'nid' => 'nullable|digits:17',
			'depot_id' => 'required',
			'division_id' => 'required',
			'district_id' => 'required',
			'thana_id' => 'required',
			'region_id' => 'required',
			'address' => 'nullable|max:255',
			'estimated_sales' => 'nullable|numeric|between:0,999999999',
			'status' => 'required',
			'permanent_address' => 'required|max:255',
			'present_address' => 'required|max:255',
			'birthday' => 'nullable|date',
			'spouse_name' => 'nullable|max:64',
			'father_name' => 'nullable|max:100',
			'mother_name' => 'nullable|max:100',
			'son' => 'nullable|numeric',
			'daughter' => 'nullable|numeric',
			'business_startday' => 'nullable|date',
			'marriage_day' => 'nullable|date',
			'spouse_birthday' => 'nullable|date',
			'code' => ['required', 'size:4', function ($attribute, $value, $fail) use ($data, $generate_code, $id) {
				$distributor_code = $generate_code . $data['code'];
				$shopCount = Shop::where('id', '<>', $id)->where('code', $distributor_code)->count();
				if ($shopCount > 0) {
					$fail(':attribute is already taken!');
				}
			}],
		];
		unset($data['distributor_id']);

		$fieldsArr = [];
		$oldFieldsArr = [];
		foreach (config('myconfig.shop_file') as $k => $v) {
			$validatorArr[$v] = 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024';
			$filesInfo = $request->file($v);
			if ($filesInfo) {
				$fieldsArr[$v] = $filesInfo;
				unset($data[$v]);
			}
			if (array_key_exists('old_' . $v, $data)) {
				$oldFieldsArr['old_' . $v] = $data['old_' . $v];
				unset($data['old_' . $v]);
			}
		}

		$request->validate($validatorArr);

		$shopData = [
			'is_distributor' => 1,
			'outlet_name' => $data['outlet_name'],
			'proprietor_name' => $data['proprietor_name'],
			'mobile' => $data['mobile'],
			'nid' => $data['nid'],
			'category' => $data['category'],
			'estimated_sales' => $data['estimated_sales'],
			'trade_license' => $data['trade_license'],
			'address' => $data['address'],
			'division_id' => $data['division_id'],
			'district_id' => $data['district_id'],
			'thana_id' => $data['thana_id'],
			'region_id' => $data['region_id'],
			'area_id' => $data['area_id'] ?? '0',
			'depot_id' => $data['depot_id'],
			'parmanent_address' => $data['permanent_address'],
			'present_address' => $data['present_address'],
			'status' => $data['status'],
		];

		//$codeArr = $this->makeCode($data['region_id'], $data['depot_id'], $id);
		$shopData['pre_code'] = $data['code'];
		$shopData['code'] = $generate_code . $data['code'];

		$shopDetailsData = [
			'birthday' => $data['birthday'],
			'spouse_name' => $data['spouse_name'],
			'father_name' => $data['father_name'],
			'mother_name' => $data['mother_name'],
			'son' => $data['son'],
			'daughter' => $data['daughter'],
			'business_startday' => $data['business_startday'],
			'marriage_day' => $data['marriage_day'],
			'spouse_birthday' => $data['spouse_birthday'],
		];

		//dd($shopDetailsData);

		$shop = Shop::find($id);
		$shop->fill($shopData);
		//dd($data);
		//$shops = $shopObj->update($shopData);
		if ($shop->save()) {

			$shopCountable = ShopDetail::where('shop_id', $id)->count();
			if ($shopCountable > 0) {
				$shopDetails = ShopDetail::where('shop_id', $id)->update($shopDetailsData);
			} else {
				$shopDetails = new ShopDetail($shopDetailsData);
				$shop->detail()->save($shopDetails);
			}

			//$shopDetails->update();
			//$shopObj->detail()->attach($shopObj->id, $shopDetailsData);

			if (count($fieldsArr)) {
				$this->storeDucuments($fieldsArr, $shopObj, null, $oldFieldsArr);
			}
			$message = "You have successfully updated";
			return redirect()->route('distributors.index')
				->with('flash_success', $message);

		} else {
			$message = "Nothing changed!! Please try again";
			return redirect()->route('distributors.index', $redirectArr)
				->with('flash_warning', $message);
		}
	}

	public function destroy(Request $request, $id) {
		$data = $request->all();
		$param = '';
		if (!empty($data['distributor_id'])) {
			$newDistributor = Shop::find($data['distributor_id']);
			$param = 1;
			//DistributorUser::where('distributor_id', $id)->update(['distributor_id' => $data['distributor_id']]);

			//inactivated distributor's all shops transferted under new distributor
			Shop::where('distributor_id', $id)->update([
				'distributor_id' => $data['distributor_id'],
				'depot_id' => $newDistributor->depot_id,
				'region_id' => $newDistributor->region_id,
				'area_id' => $newDistributor->area_id,
			]);

			//inactivated distributor's all requisition transferted under new distributor
			Requisition::where('distributor_id', $id)->update([
				'distributor_id' => $data['distributor_id'],
			]);

		} else {
			$msg = $this->checkUses($id, 'shop_id', ['Requisition', 'Settlement']);
			if ($msg != 'no') {
				return $msg;
			}

		}

		//distributor or shop inactivate
		$shops = Shop::where('id', $id)->update(['status' => 'inactive']);
		if ($shops) {
			$message = "You have successfully inactivated";
			return redirect()->route('shops.index', [$param])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('shops.index', [$param])
				->with('flash_danger', $message);
		}
	}

	public function showProfile(Request $request) {

		$profile = collect([]);
		$profileId = null;

		$authUserId = auth()->user()->id;
		$authUserDistibutorIds = DistributorUser::where('user_id', $authUserId)->pluck('distributor_id');
		$distributors = Shop::whereIn('id', $authUserDistibutorIds)
			->where('status', 'active')
			->select(DB::raw('CONCAT(outlet_name, if(code is null, "", CONCAT("-",code)) ) as profile, id'))
			->pluck('profile', 'id');

		if ($request->isMethod('post')) {

			$request->validate([
				'profileId' => 'required',

			]);

			$is_download = $request->input('is_download');

			$profileId = $request->input('profileId');

			$profile = Shop::find($profileId);
		}

		if (isset($is_download) AND $is_download > 0) {

			$fileName = 'Distributor-' . $profileId;

			$pdf = \domPDF::loadView('distributors.profile_pdf', compact('profile', 'is_download'));
			$customPaper = array(0, 0, 950, 950);
			return $pdf->setPaper($customPaper, 'landscape')->setWarnings(false)->download($fileName . '.pdf');

		}

		return view('distributors.profile', compact('profileId', 'distributors', 'profile', 'is_download'));
	}

	public function download() {

		$filename = 'distributors.xlsx';

		return (new DistributorsExport())->download($filename);
	}
}
