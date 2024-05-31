<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model {
	public $timestamps = false;
	protected $guarded = array('id');

	public function stage_details() {
		return $this->hasMany(StageDetail::class);
	}
	// this is a recommended way to declare event handlers
	protected static function boot() {
	    parent::boot();
	    static::deleting(function ($stage) {
	        // before delete() method call this
	        $stage->stage_details()->delete();
	        // do the rest of the cleanup...
	    });
	}
}
