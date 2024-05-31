<?php
namespace App\Repositories\Models;

use App\Repositories\Repository;
use App\Zone;
use Illuminate\Database\Eloquent\Model;

class ZoneRepository extends Repository {

    // Constructor to bind model to repo
    public function __construct() {
        $zone = new Zone;
        parent::__construct($zone);
    }

    // Get all instances of model
    public function all() {
        return $this->model->all();
    }

    public function getRegions($user_id) {

        //return $this->model->whereNull('parent_id')->pluck('name', 'id');

        return $this->model->whereNull('zones.parent_id')
            ->join('depots', 'depots.region_id', '=', 'zones.id')
            ->join('depot_users', 'depot_users.depot_id', '=', 'depots.id')
            ->select('zones.id', 'zones.name')
            ->groupBy(['zones.id', 'zones.name'])
            ->where('depot_users.user_id', $user_id)
            ->pluck('name', 'id');
    }

    public function depots($regionIds = []) {

        if ($regionIds) {
            return $this->model::with('depots')
                ->whereNull('parent_id')
                ->whereIn('id', $regionIds)
                ->get();
        }

        return $this->model::with('depots')
            ->whereNull('parent_id')
            ->get();

    }

}
