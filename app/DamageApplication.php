<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamageApplication extends Model {
	//public $timestamps = false;
	protected $guarded = array('id');

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'damage_type_id', 'depot_id', 'item_id', 'remarks', 'status', 'shop_id','df_problem_id','stage'
	];

	public function item() {
		return $this->belongsTo(Item::class);
	}
	public function depot() {
		return $this->belongsTo(Depot::class);
	}
	public function damage_type() {
		return $this->belongsTo(DamageType::class);
	}
	public function shop() {
		return $this->belongsTo(Shop::class);
	}
	public function settlement() {
		return $this->hasOne(Settlement::class, 'item_id', 'item_id');
	}
}
