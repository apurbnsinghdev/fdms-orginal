<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
	//public $timestamps = false;
	protected $guarded = array('id');
	public function stocks() {
		return $this->hasMany(Stock::class, 'origin', 'country_code');
	}
}
