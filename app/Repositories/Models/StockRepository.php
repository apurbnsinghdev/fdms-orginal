<?php
namespace App\Repositories\Models;

use App\Repositories\Repository;
use App\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class StockRepository extends Repository {

    // model property on class instances
    //protected $model;

    // Constructor to bind model to repo
    public function __construct() {
        $stock = new Stock;
        parent::__construct($stock);
    }

    // Get all instances of model
    public function all() {
        return $this->model->all();
    }

    public function getStockHistory($yearOrDate = 'Year', $start_date = '', $end_date = '') {
        if ($yearOrDate == 'Year') {
            $stocks = Stock::with('stock_details')
                ->whereRaw('YEAR(invoice_date) between ? AND ?', [$start_date, $end_date])
                ->select('id', 'invoice_date')
                ->get();
        } else {
            $start_date = Carbon::parse($start_date)->format('Y-m-d');
            $end_date = Carbon::parse($end_date)->format('Y-m-d');
            $stocks = Stock::with('stock_details')
                ->whereRaw('DATE(invoice_date) between ? AND ?', [$start_date, $end_date])
                ->select('id', 'invoice_date')
                ->get();
        }

        return $stocks;
    }

}
