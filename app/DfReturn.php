<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DfReturn extends Model {
	//public $timestamps = false;
	protected $guarded = array('id');
	protected $dates = ['created_at', 'updated_at', 'withdrawal_date'];

	public function creator() {
		return $this->belongsTo(User::class, 'user_id');
	}
	public function shop() {
		return $this->belongsTo(Shop::class);
	}
	public function depot() {
		return $this->belongsTo(Depot::class);
	}
	public function currentdf() {
		return $this->belongsTo(Item::class, 'current_df');
	}
	public function distributor() {
		return $this->belongsTo(Shop::class, 'distributor_id');
	}
	public function to_outlet() {
		return $this->belongsTo(Shop::class, 'to_shop');
	}
	public function stager() {
		return $this->belongsTo(User::class, 'action_by');
	}
	public function comments() {
		return $this->hasMany(DfReturnLog::class);
	}
}
