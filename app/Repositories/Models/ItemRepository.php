<?php
namespace App\Repositories\Models;

use App\Item;
use App\Repositories\Repository;
use DB;
use Illuminate\Database\Eloquent\Model;

class ItemRepository extends Repository {

    // model property on class instances
    //protected $model;

    // Constructor to bind model to repo
    public function __construct() {
        $item = new Item;
        parent::__construct($item);
    }

    // Get all instances of model
    public function all() {
        return $this->model->all();
    }

    /*
     * Get all relation betwen item,depot,size
     * @param $year
     * @return mixed @array
     */
    public function getWithDepotsSizesByYear($year, $sizeIds) {
        $items = $this->model
            ->whereYear('created_at', '<=', $year)
            ->groupBy(['depot_id', 'size_id'])
            ->select('depot_id', 'size_id', DB::raw('count(size_id) as totalSize'))
            ->orderBy('depot_id', 'ASC')->orderBy('size_id', 'ASC');

        if ($sizeIds) {
            $items->whereIn('size_id', $sizeIds);
        }

        return $items->get();
    }

    /*
     * Get Distributor Deep Freeze item list
     * @param $year
     * @return mixed @array
     */
    public function getDepotsDistributorSizes($year, $sizeIds = []) {

        $items = $this->model
            ->join('settlements AS s', 's.item_id', '=', 'items.id')
            ->join('shops AS sop', 'sop.id', '=', 's.shop_id')
            ->join('shops AS d', 'd.id', '=', 'sop.distributor_id')
            ->whereYear('s.inject_date', $year)->where('s.status', 'continue')
            ->select('items.depot_id', 'sop.distributor_id', 'd.outlet_name', 'items.size_id', DB::raw('count(items.size_id) as totalSize'))
            ->groupBy(['items.depot_id', 's.shop_id', 'items.size_id'])
            ->orderBy('items.size_id', 'ASC');

        if ($sizeIds) {
            $items->whereIn('items.size_id', $sizeIds);
        }

        return $items->get();
    }

}
