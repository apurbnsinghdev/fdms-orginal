<?php

namespace App\Repositories\Traits;
use DB;
use Illuminate\Support\Carbon;

trait BrandWiseDF {

    /*
     * Get List of items where item is settled
     * Multiple filter condition
     * @param (int) $year, (array) $brandIds
     * @return query object
     */

    private function brandWiseDFItems($start_date, $end_date, $brandIds = [], $sizeIds = []) {

        $items = DB::table('items')
            ->select('depot_id', 'brand_id', 'size_id', DB::raw('count(size_id) as total'))
            ->groupBy(['depot_id', 'brand_id', 'size_id'])
            ->orderBy('depot_id', 'ASC')
            ->orderBy('brand_id', 'ASC');

        $start_date = Carbon::parse($start_date)->format('Y-m-d');
        $end_date = Carbon::parse($end_date)->format('Y-m-d');
        $items->whereBetween('created_at', [$start_date, $end_date]);

        if ($brandIds) {
            $items->whereIn('brand_id', $brandIds);
        }

        if ($sizeIds) {
            $items->whereIn('size_id', $sizeIds);
        }

        return $items;
    }

    /*
     * Get brand wise Deep Freeze Status
     * Multiple filter condition
     * @param (date) $start_date, (date) $end_date, (array) $brandIds
     * @return collection
     */

    public function getRegionWiseBrandDFStatus($start_date, $end_date, $regionIds = [], $brandIds = [], $sizeIds = []) {

        //$items = $this->brandWiseDFItems($start_date, $end_date, $brandIds, $sizeIds);

        $start_date = Carbon::parse($start_date)->format('Y-m-d');
        $end_date = Carbon::parse($end_date)->format('Y-m-d');

        $results = DB::table('settlements')
            ->join('items', 'items.id', '=', 'settlements.item_id')
            ->join('shops', function ($join) {
                $join->on('shops.id', '=', 'settlements.shop_id');

            })
            ->select('shops.region_id as zone_id', 'shops.depot_id', 'items.brand_id', 'items.size_id', DB::raw('count(items.size_id) as total'))
            ->whereIn('settlements.status', ['continue', 'reserve'])
            ->whereRaw('YEAR(settlements.inject_date) between ? AND ?', [$start_date, $end_date])
            ->groupBy(['shops.region_id', 'shops.depot_id', 'items.brand_id', 'items.size_id']);
        /*
        $results = DB::table('depots')
        ->leftJoinSub($items, 'items', function ($join) {
        $join->on('depots.id', '=', 'items.depot_id');
        })
        ->join('zones', 'zones.id', '=', 'depots.region_id')
        ->select('depots.id as depot_id', 'items.brand_id', 'items.total', 'items.size_id', 'zones.id as zone_id');
         */

        if ($regionIds) {
            $results->whereIn('shops.region_id', $regionIds);
        }

        return $results->get();
    }

    public function getLocationWiseBrandDFStatus($start_date, $end_date, $brandIds = [], $sizeIds = [], $divisionIds = 0, $districtIds = 0, $thanaIds = 0) {

        $start_date = Carbon::parse($start_date)->format('Y-m-d');
        $end_date = Carbon::parse($end_date)->format('Y-m-d');

        $results = DB::table('settlements AS st')
            ->join('items as i', 'i.id', '=', 'st.item_id')
            ->join('shops as s', 's.id', '=', 'st.shop_id')
            ->select('s.division_id', 's.district_id', 's.thana_id', 'i.brand_id', 'i.size_id', DB::raw('count(size_id) as total'))
            ->whereIn('st.status', ['continue', 'reserve'])
            ->whereRaw('YEAR(st.inject_date) between ? AND ?', [$start_date, $end_date])
            ->groupBy(['s.division_id', 's.district_id', 's.thana_id', 'i.brand_id', 'i.size_id']);

        if ($brandIds) {
            $results->whereIn('i.brand_id', $brandIds);
        }

        if ($sizeIds) {
            $results->whereIn('i.size_id', $sizeIds);
        }

        if ($divisionIds) {
            $results->whereIn('s.division_id', $divisionIds);
        }

        if ($districtIds) {
            $results->whereIn('s.district_id', $districtIds);
        }

        if ($thanaIds) {
            $results->whereIn('s.thana_id', $thanaIds);
        }

        return $results->get();
    }

    public function getDepotWiseBrandDFStatus($start_date, $end_date, $brandIds, $sizeIds, $depotIds, $distributorIds) {

        $start_date = Carbon::parse($start_date)->format('Y-m-d');
        $end_date = Carbon::parse($end_date)->format('Y-m-d');

        $shops = DB::table('shops')
            ->join('shops AS distributor', 'distributor.id', '=', 'shops.distributor_id')
            ->select('shops.id', 'shops.depot_id', 'distributor.id as distributor_id', 'shops.outlet_name as shop', 'distributor.outlet_name as distributor')
            ->whereRaw('shops.distributor_id IS NOT NULL');

        $results = DB::table('settlements')
            ->join('items', 'items.id', '=', 'settlements.item_id')
            ->joinSub($shops, 'shops', function ($join) {
                $join->on('shops.id', '=', 'settlements.shop_id');
            })
            ->select('shops.depot_id', 'shops.distributor_id', 'items.brand_id', 'items.size_id', DB::raw('count(items.size_id) as total'))
            ->whereIn('settlements.status', ['continue', 'reserve'])
            ->whereRaw('DATE(settlements.inject_date) between ? AND ?', [$start_date, $end_date])
            ->groupBy(['shops.depot_id', 'shops.distributor_id', 'items.brand_id', 'items.size_id']);

        if ($brandIds) {
            $results->whereIn('items.brand_id', $brandIds);
        }

        if ($sizeIds) {
            $results->whereIn('items.size_id', $sizeIds);
        }

        if ($depotIds) {
            $results->whereIn('shops.depot_id', $depotIds);
        }

        if ($distributorIds) {
            $results->whereIn('shops.distributor_id', $distributorIds);
        }
        //dd($results->toSql());
        return $results->get();
    }
}