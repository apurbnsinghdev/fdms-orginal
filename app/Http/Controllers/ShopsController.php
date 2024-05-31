<?php

namespace App\Http\Controllers;

use App\Depot;
use App\DepotUser;
use App\DistributorUser;
use App\Document;
use App\Exports\ShopExport;
use App\Location;
use App\Requisition;
use App\Shop;
use App\Traits\DocumentsUpload;
use App\Zone;
use Illuminate\Http\Request;

class ShopsController extends Controller {
    use DocumentsUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param = '0') {
        $authUserId = auth()->user()->id;
        $depotIds = DepotUser::where('user_id', $authUserId)->pluck('depot_id');
        $distributors = collect([]);
        if ($depotIds->count() == 1) {
            $depots = collect([]);
            $distributors = Shop::where('depot_id', $depotIds[0])
            ->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.id')
            ->where('distributor_users.user_id', $authUserId)
            ->pluck('shops.outlet_name', 'shops.id');
        } else {
            $depots = Depot::whereIn('id', $depotIds)->pluck('name', 'id');
        }
        return view('shops.index', compact('param','depots','distributors'));
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

        return view('shops.create', compact('divisions', 'regionId', 'regions', 'areas', 'depotId', 'depots', 'distributors'));
    }

    private function makeCode($regionId, $depotId, $id = null) {
        $regionCode = Zone::where('id', $regionId)->value('code') ?: '00';
        $depotCode = Depot::where('id', $depotId)->value('code') ?: '00';
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
        if (empty($data['is_distributor'])) {
            $validatorArr = [
                'outlet_name' => 'required',
                'proprietor_name' => 'required',
                'mobile' => 'required|digits:11|unique:shops,mobile,NULL,id,outlet_name,' . $data['outlet_name'],
                'nid' => 'nullable',
                'depot_id' => 'required',
                'division_id' => 'required',
                'district_id' => 'required',
                'distributor_id' => 'required',
                'thana_id' => 'required',
                'region_id' => 'required',
                'address' => 'required|max:255',
                'parmanent_address' => 'required|max:255',
                'present_address' => 'required|max:255',
                'estimated_sales' => 'nullable|numeric|between:0,999999999',
            ];
        } else {
            $redirectArr = [1];
            $validatorArr = [
                'outlet_name' => 'required',
                'proprietor_name' => 'required',
                'mobile' => 'required|digits:11|unique:shops,mobile,NULL,id,outlet_name,' . $data['outlet_name'],
                'nid' => 'nullable|digits:17',
                'depot_id' => 'required',
                'division_id' => 'required',
                'district_id' => 'required',
                'thana_id' => 'required',
                'region_id' => 'required',
                'address' => 'nullable|max:255',
                'parmanent_address' => 'required|max:255',
                'present_address' => 'required|max:255',
                'estimated_sales' => 'nullable|numeric|between:0,999999999',
            ];
            unset($data['distributor_id']);

            //distributor code make
            $codeArr = $this->makeCode($data['region_id'], $data['depot_id']);
            $data['pre_code'] = $codeArr['pre_code'];
            $data['code'] = $codeArr['code'];
        }

        $redirectAdress = 'shops.index';
        $requisition = false;
        if (array_key_exists('requisition', $data)) {
            $redirectAdress = 'requisitions.create';
            $requisition = true;
            unset($data['requisition']);
        }

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

        //dd($data);
        $shops = Shop::create($data);
        if ($shops) {

            //add permission for newly created distributor
            if ($shops->is_distributor) {
                DistributorUser::create([
                    'distributor_id' => $shops->id,
                    'user_id' => auth()->user()->id,
                ]);
            }

            //document upload
            if (count($fieldsArr)) {
                $this->storeDucuments($fieldsArr, $shops);
            }
            $message = "You have successfully created shop";
            if ($requisition) {
                $redirectArr = [$shops->id];
            }
            return redirect()->route($redirectAdress, $redirectArr)
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('shops.index', $redirectArr)
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
        return view('shops.edit', compact('shops', 'divisions', 'districts', 'thanas', 'areas', 'regionId', 'regions', 'depots', 'distributors', 'depotId', 'documents'));
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
        if (empty($data['is_distributor'])) {
            $validatorArr = [
                'outlet_name' => 'required',
                'proprietor_name' => 'required',
                //'mobile' => 'required|digits:11|unique:shops,id,' . $id,
                'mobile' => 'required|digits:11|unique:shops,mobile,' . $id . ',id,outlet_name,' . $data['outlet_name'],
                'nid' => 'nullable',
                'depot_id' => 'required',
                'division_id' => 'required',
                'district_id' => 'required',
                'distributor_id' => 'required',
                'thana_id' => 'required',
                'region_id' => 'required',
                'address' => 'required|max:255',
                'estimated_sales' => 'nullable|numeric|between:0,999999999',
                'status' => 'required',
                'parmanent_address' => 'required|max:255',
                'present_address' => 'required|max:255',
            ];
            $data['is_distributor'] = 0; //set this shop for retailer
        } else {
            $redirectArr = [1];
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
                'parmanent_address' => 'required|max:255',
                'present_address' => 'required|max:255',
            ];
            unset($data['distributor_id']);
            //distributor code make
            $codeArr = $this->makeCode($data['region_id'], $data['depot_id'], $id);
            $data['pre_code'] = $codeArr['pre_code'];
            $data['code'] = $codeArr['code'];
        }

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

        $shopObj = Shop::find($id);
        //dd($data);
        $shops = $shopObj->update($data);
        if ($shops) {
            if (count($fieldsArr)) {
                $this->storeDucuments($fieldsArr, $shopObj, null, $oldFieldsArr);
            }
            $message = "You have successfully updated";
            return redirect()->route('shops.index', $redirectArr)
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('shops.index', $redirectArr)
                ->with('flash_warning', $message);
        }
    }

    //shop and requisition transfer in form selected distributor
    public function distributorShopTransfer(Request $request, $id) {
        $data = $request->except('_method', '_token', 'basic-table_length');

        $request->validate([
            'shop_ids' => 'required',
            'distributor_id' => 'required',
        ]);
        $shops = Shop::whereIn('id', $data['shop_ids'])
            ->update(['distributor_id' => $data['distributor_id']]);
        Requisition::whereIn('shop_id', $data['shop_ids'])->update(['distributor_id' => $data['distributor_id']]);
        $message = "You have successfully updated";
        return redirect()->route('distributor.shops', [$id])
            ->with('flash_success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $data = $request->all();
        $param = '';
        $redirect = 'shops.index';
        if (!empty($data['distributor_id'])) {
            $redirect = 'distributors.index';
            $newDistributor = Shop::find($data['distributor_id']);
            $param = '';
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
            return redirect()->route($redirect, [$param])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route($redirect, [$param])
                ->with('flash_danger', $message);
        }
    }
    public function download(Request $request,$param = '0') {
        $data = $request->except('_method', '_token');
        $depot_id = $distributor_id = 0;
        if(!empty($data['depot_id'])){
            $depot_id = $data['depot_id'];
        }
        if(!empty($data['distributor_id'])){
            $distributor_id = $data['distributor_id'];
        }
        if ($param == '0') {
            $filename = 'Injected-DF-Retailer.xlsx';
        } else {
            $filename = 'Not-Injected-DF-Retailer.xlsx';
        }

        return (new ShopExport($param,$depot_id,$distributor_id))->download($filename);
    }
}
