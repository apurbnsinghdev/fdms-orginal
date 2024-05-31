<?php
namespace App\Repositories\Models;

use App\DamageApplication;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class DamageApplicationRepository extends Repository {

    // model property on class instances
    //protected $model;

    // Constructor to bind model to repo
    public function __construct() {
        $damageApplication = new DamageApplication;
        parent::__construct($damageApplication);
    }

    // Get all instances of model
    public function all() {
        return $this->model->all();
    }
 
    public function getDamageList($start_date,$end_date,$regionIds=[],$depotIds=[],$damageTypeIds=[]) {
        $start_date = Carbon::parse($start_date)->format('Y-m-d');
        $end_date = Carbon::parse($end_date)->format('Y-m-d');
        $damageApplications = $this->model
        ->join('shops','shops.id','=','damage_applications.shop_id')
        ->join('zones','zones.id','=','shops.region_id')
        ->join('items','items.id','=','damage_applications.item_id')
        ->join('damage_types','damage_types.id','=','damage_applications.damage_type_id')
        ->join('settlements','settlements.damage_application_id','=','damage_applications.id')
        ->select(
            'damage_applications.id',
            'damage_applications.remarks',
            'damage_types.name',
            'shops.outlet_name',
            'zones.name as region_name',
            'items.serial_no',
            'settlements.inject_date',
            'settlements.month_from',
            'settlements.month_to',
            'settlements.closed_date',
            'settlements.receive_amount',
            'settlements.status'
            )
        ->whereBetween('settlements.closed_date', [$start_date, $end_date])
        ->whereIn('settlements.status',['replace','closed'])
        ->orderBy('settlements.closed_date', 'desc');
        
        if ($regionIds) {
            $damageApplications->whereIn('shops.region_id', $regionIds);
        }
        if ($depotIds) {
            $damageApplications->whereIn('damage_applications.depot_id', $depotIds);
        }
        if ($damageTypeIds) {
            $damageApplications->whereIn('damage_applications.damage_type_id', $damageTypeIds);
        }
     
        return $damageApplications->get();
        
    }

}
