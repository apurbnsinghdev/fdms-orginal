<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionLog extends Model {
	protected $guarded = array('id');

	public function user() {
		return $this->belongsTo(User::class);
	}
}
