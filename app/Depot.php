<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depot extends Model {
	public $timestamps = false;
	protected $guarded = array('id');

	public function division() {
		return $this->belongsTo(Location::class);
	}

	public function district() {
		return $this->belongsTo(Location::class);
	}

	public function thana() {
		return $this->belongsTo(Location::class);
	}

	public function region() {
		return $this->belongsTo(Zone::class);
	}
	public function area() {
		return $this->belongsTo(Zone::class);
	}
	public function designation() {
		return $this->belongsTo(Designation::class);
	}
	public function distributors() {
		return $this->hasMany(Shop::class)->where('is_distributor', true);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function availableQty() {
		return $this->hasMany(Item::class)->availableDFQty();
	}

	public function availableDepotStocksForHold($from_depot) {
		return \App\Item::with([
			'size' => function ($q) {
				return $q->select('id', 'name');
			},
			'brand' => function ($q) {
				return $q->select('id', 'short_code');
			},
		])
			->select('items.size_id', 'items.brand_id', \DB::raw('COUNT(items.id) as total'))
			->availableDFQty()
			->where('items.depot_id', $from_depot)
			->groupBy(['items.size_id', 'items.brand_id'])
			->get();
	}

}
