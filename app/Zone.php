<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {
    public $timestamps = false;
    protected $guarded = array('id');

    public function parent() {
        return $this->belongsTo(Zone::class, 'parent_id');
    }

    //each category might have multiple children
    public function children() {
        return $this->hasMany(Zone::class, 'parent_id');
    }

    public function depots() {
        return $this->hasMany(Depot::class, 'region_id');

    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();
        static::deleting(function ($zone) {
            // before delete() method call this
            // foreach ($zone->children as $child) {
            //     $child->children()->delete();
            // }
            $zone->children()->delete();
            // do the rest of the cleanup...
        });
    }

}
