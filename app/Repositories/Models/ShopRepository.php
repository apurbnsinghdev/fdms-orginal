<?php
namespace App\Repositories\Models;

use App\Repositories\Repository;
use App\Shop;
use Illuminate\Database\Eloquent\Model;

class ShopRepository extends Repository {

    // Constructor to bind model to repo
    public function __construct() {
        $zone = new Shop;
        parent::__construct($zone);
    }

    // Get all instances of model
    public function all() {
        return $this->model->all();
    }

    public function distributor() {
        return $this->model::with('distributor')->get();
    }

}
