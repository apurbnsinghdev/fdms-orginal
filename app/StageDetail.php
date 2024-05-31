<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StageDetail extends Model {
	public $timestamps = false;
	protected $guarded = array('id');

	public function stage() {
		return $this->belongsTo(Stage::class);
	}
	
	public function designation() {
	    return $this->belongsTo(Designation::class);
	}
}
