<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {
	//public $timestamps = false;
	protected $guarded = array('id');

	public function shop() {
		return $this->belongsTo(Shop::class);
	}

	public function requisition() {
		return $this->belongsTo(Requisition::class, 'data_id')->where('module', 'requisition');
	}
}
