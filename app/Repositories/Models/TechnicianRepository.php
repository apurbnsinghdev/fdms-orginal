<?php
namespace App\Repositories\Models;

use App\Repositories\Repository;
use App\Technician;
use Illuminate\Database\Eloquent\Model;

class TechnicianRepository extends Repository {

    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct() {
        $depot = new Technician;
        parent::__construct($depot);
    }

    // Get all instances of model
    public function all() {
        return $this->model->all();
    }

    public function getDepotTechnicians($regionIds = [], $depotIds = []) {
        $technician = $this->model
            ->join('depots', 'depots.id', '=', 'technicians.depot_id')
            ->select('technicians.id', 'technicians.name', 'depots.name as depot');

        if ($regionIds) {
            $technician->whereIn('depots.region_id', $regionIds);
        }

        if ($depotIds) {
            $technician->whereIn('technicians.depot_id', $depotIds);
        }

        return $technician->get();
    }
}
