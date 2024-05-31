<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopDetail extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['birthday', 'spouse_name', 'father_name', 'mother_name', 'son', 'daughter', 'business_startday', 'marriage_day', 'spouse_birthday'];
    public function shop() {
        return $this->belongsTo('App\Shop');
    }
}
