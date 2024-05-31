<?php

namespace App;

use App\Traits\Excludable;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model {
	use Excludable;
	public $timestamps = false;
	protected $guarded = array('id');

	public function scopeGetMessage($query, $action) {
		return $query->where('status', 'active')->where('action', $action)->select('subject', 'message', 'designations')->get();
	}

	public function scopeExclude($query, $columns) {
		return $query->select(array_diff($this->getTableColumns(), (array) $columns));
	}

}
