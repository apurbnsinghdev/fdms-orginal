<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model {
	//public $timestamps = false;
	protected $dates = ['created_at', 'updated_at', 'invoice_date', 'lc_date'];
	protected $guarded = array('id');

	public function stock_details() {
		return $this->hasMany(StockDetail::class);
	}

	public function supplier() {
		return $this->belongsTo(Supplier::class);
	}

	public function country() {
		return $this->belongsTo(Country::class, 'origin', 'country_code');
	}
	// this is a recommended way to declare event handlers
	protected static function boot() {
		parent::boot();
		static::deleting(function ($stock) {
			// before delete() method call this
			$stock->stock_details()->delete();
			// do the rest of the cleanup...
		});
	}
}
