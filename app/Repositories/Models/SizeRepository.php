<?php
namespace App\Repositories\Models;

use App\Repositories\Repository;
use App\Size;
use Illuminate\Database\Eloquent\Model;

class SizeRepository extends Repository {

    // Constructor to bind model to repo
    public function __construct() {
        $size = new Size;
        parent::__construct($size);
    }

    // Get all instances of model
    public function all() {
        return $this->model->all();
    }

    public function getAll() {

        return $this->model->where('availability', '=', 'yes')->orderBy('name')->get();
    }

    public function getAvailabeSize($sizeIds = array()) {

        $size = $this->model->where('availability', '=', 'yes')->orderBy('name');

        if ($sizeIds) {
            $size->whereIn('id', $sizeIds);
        }

        return $size->pluck('name', 'id');
    }

}
