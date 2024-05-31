<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoldStock extends Model {

	public $timestamps = false;
	protected $guarded = array('id');

	public function depot() {
		return $this->belongsTo(Depot::class);
	}

	public function brand() {
		return $this->belongsTo(Brand::class);
	}

	public function size() {
		return $this->belongsTo(Size::class);
	}
}
