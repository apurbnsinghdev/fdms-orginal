<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model {
	public $timestamps = false;
	protected $guarded = array('id');

	public function stock() {
		return $this->belongsTo(Stock::class);
	}

	public function brand() {
		return $this->belongsTo(Brand::class);
	}
	public function size() {
		return $this->belongsTo(Size::class);
	}
}
