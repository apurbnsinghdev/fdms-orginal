<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllocationDetail extends Model {
	public $timestamps = false;
	protected $guarded = array('id');

	public function stock_detail() {
		return $this->belongsTo(StockDetail::class);
	}
}
