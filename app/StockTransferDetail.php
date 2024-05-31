<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockTransferDetail extends Model {

    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    public function size() {
        return $this->belongsTo(Size::class);
    }
}
