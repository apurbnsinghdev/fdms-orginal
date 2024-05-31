<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {
    public $timestamps = false;
    protected $guarded = array('id');

    public function parent() {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    //each category might have multiple children
    public function children() {
        return $this->hasMany(Location::class, 'parent_id');
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();
        static::deleting(function ($location) {
            // before delete() method call this
            foreach ($location->children as $child) {
                $child->children()->delete();
            }
            $location->children()->delete();
            // do the rest of the cleanup...
        });
    }

}
