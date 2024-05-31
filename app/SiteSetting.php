<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model {
	public $timestamps = false;
	protected $guarded = array('id');
}
