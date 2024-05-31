<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model {
	//public $timestamps = false;
	protected $guarded = array('id');

	public function allocation_details() {
		return $this->hasMany(AllocationDetail::class);
	}
	public function stock() {
		return $this->belongsTo(Stock::class);
	}
	public function depot() {
		return $this->belongsTo(Depot::class);
	}
	
	// this is a recommended way to declare event handlers
	protected static function boot() {
	    parent::boot();
	    static::deleting(function ($allocation) {
	        // before delete() method call this
	        $allocation->allocation_details()->delete();
	        // do the rest of the cleanup...
	    });
	}
}
