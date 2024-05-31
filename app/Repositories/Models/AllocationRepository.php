<?php
namespace App\Repositories\Models;

use App\Allocation;
use App\Repositories\Repository;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class AllocationRepository extends Repository {

    // model property on class instances
    //protected $model;

    // Constructor to bind model to repo
    public function __construct() {
        $allocation = new Allocation;
        parent::__construct($allocation);
    }

    // Get all instances of model
    public function all() {
        return $this->model->all();
    }

    public function getAllocationHistory($yearOrDate = 'Year', $start_date = '', $end_date = '') {

        if ($yearOrDate == 'Year') {
            $allocations = Allocation::whereRaw('YEAR(allocations.created_at) between ? AND ?', [$start_date, $end_date])
                ->select(DB::raw('DATE_FORMAT(allocations.created_at,"%d.%m.%y") as created'), 'allocations.depot_id', 'stock_details.size_id', 'allocation_details.receive_qty as total')
                ->join('allocation_details', 'allocation_details.allocation_id', '=', 'allocations.id')
                ->join('stock_details', 'stock_details.id', '=', 'allocation_details.stock_detail_id')
                ->get();
        } else {
            $start_date = Carbon::parse($start_date)->format('Y-m-d');
            $end_date = Carbon::parse($end_date)->format('Y-m-d');

            $allocations = Allocation::whereRaw('DATE(allocations.created_at) between ? AND ?', [$start_date, $end_date])
                ->select(DB::raw('DATE_FORMAT(allocations.created_at,"%d.%m.%y") as created'), 'allocations.depot_id', 'stock_details.size_id', 'allocation_details.receive_qty as total')
                ->join('allocation_details', 'allocation_details.allocation_id', '=', 'allocations.id')
                ->join('stock_details', 'stock_details.id', '=', 'allocation_details.stock_detail_id')
                ->get();
        }
        return $allocations;
    }

}
