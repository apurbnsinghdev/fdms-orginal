<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model {
    //public $timestamps = false;
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

    public function depot() {
        return $this->belongsTo(Depot::class);
    }

    public function distributor() {
        return $this->belongsTo(Shop::class, 'distributor_id')->where('is_distributor', true);
    }
    public function retailers() {
        return $this->hasMany(Shop::class, 'distributor_id');
    }
    public function documents() {
        return $this->hasMany(Document::class);
    }

    public function items() {
        return $this->hasMany(Item::class);
    }
    public function requisitions() {
        return $this->hasMany(Requisition::class);
    }

    /**
     * Get the phone record associated with the user.
     */
    public function detail() {
        return $this->hasOne('App\ShopDetail');
    }
}
