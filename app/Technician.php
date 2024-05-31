<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    public $timestamps = false;
    protected $guarded = array('id');
    
    public function depot(){
        return $this->belongsTo(Depot::class);
    }
}
