<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {
	public $timestamps = false;
	protected $guarded = array('id');

	public function getBrandNameAttribute() {
		return $this->name . '(' . $this->short_code . ')';
	}

}
