<?php
namespace App\Repositories\Models;

use App\Depot;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class DepotRepository extends Repository {

	// model property on class instances
	protected $model;

	// Constructor to bind model to repo
	public function __construct() {
		$depot = new Depot;
		parent::__construct($depot);
	}

	// Get all instances of model
	public function all() {
		return $this->model->all();
	}

	public function getAll() {
		return $this->model->whereNotNull('name')->orderBy('code')->pluck('name', 'id');
	}

	public function getCodes($depotIds) {
		$depots = $this->model->whereNotNull('name')
			->orderBy('code');

		if ($depotIds) {
			$depots->whereIn('id', $depotIds);
		}

		return $depots->pluck('code', 'id');
	}

	public function getAllByUserID($user_id) {
		//return $this->model->whereNotNull('name')->orderBy('code')->pluck('name', 'id');

		return $this->model->whereNotNull('depots.name')
			->join('depot_users', 'depot_users.depot_id', '=', 'depots.id')
			->select('depots.id', 'depots.name')
			->groupBy(['depots.id', 'depots.name'])
			->orderBy('depots.code')
			->where('depot_users.user_id', $user_id)
			->pluck('name', 'id');
	}

	public function getRegionWiseLists($user_id = 0, $regionIds = []) {

		$depots = $this->model->whereNotNull('depots.name')
			->join('depot_users', 'depot_users.depot_id', '=', 'depots.id')
			->join('zones', 'zones.id', '=', 'depots.region_id')
			->select('depots.id', 'depots.name', 'depots.code', 'depots.region_id', 'zones.name as zone_name')
			->groupBy(['depots.id', 'depots.name', 'depots.code', 'depots.region_id', 'zones.name'])
			->orderBy('depots.code');
		if ($user_id > 0) {

			$depots->join('distributor_users', 'distributor_users.user_id', '=', 'depot_users.user_id')
				->where('depot_users.user_id', $user_id);
		}

		if ($regionIds) {
			$depots->whereIn('zones.id', $regionIds);
		}

		return $depots->get();
	}

	public function getDepotCodeLists($user_id = 0, $regionIds = [], $depotIds = []) {

		$depots = $this->model->whereNotNull('depots.name')
			->join('depot_users', 'depot_users.depot_id', '=', 'depots.id')
			->join('df_problems', 'df_problems.depot_id', '=', 'depots.id')
			->select('df_problems.region_id', 'df_problems.depot_id', 'depots.name', 'df_problems.df_code')
			->groupBy(['df_problems.region_id', 'df_problems.depot_id', 'depots.name', 'df_problems.df_code'])
			->where('df_problems.df_code', '<>', 'personal')
			->orderBy('df_problems.df_code');

		if ($user_id > 0) {
			$depots->where('depot_users.user_id', $user_id);
		}

		if ($regionIds) {
			$depots->whereIn('df_problems.region_id', $regionIds);
		}

		if ($depotIds) {
			$depots->whereIn('depots.id', $depotIds);
		}

		return $depots->get();
	}

	public function distributors($depotIds, $distributorIds = []) {
		if ($depotIds) {
			return $this->model::with(['distributors' => function ($q) use ($distributorIds) {
				if ($distributorIds) {
					return $q->select('id', 'depot_id', 'code', 'outlet_name')
						->whereIn('id', $distributorIds);
				}
				return $q->select('id', 'depot_id', 'code', 'outlet_name');
			}])
				->select('id', 'name')
				->whereIn('id', $depotIds)
				->get();
		}
		return $this->model::with(['distributors' => function ($q) {
			return $q->select('id', 'depot_id', 'code', 'outlet_name');
		}])
			->select('id', 'name')
			->get();
	}

}
