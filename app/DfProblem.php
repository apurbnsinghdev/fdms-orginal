<?php

namespace App;

use App\ComplainType;
use Illuminate\Database\Eloquent\Model;

class DfProblem extends Model {
	//public $timestamps = false;
	protected $dates = ['done_date', 'attain_date', 'created_at', 'updated_at', 'delivery_date'];
	protected $guarded = array('id');

	public function complain_types() {
		return $this->hasMany(ComplainType::class);
	}

	public function region() {
		return $this->belongsTo(Zone::class, 'region_id');
	}
	public function depot() {
		return $this->belongsTo(Depot::class);
	}

	public function shop() {
		return $this->belongsTo(Shop::class);
	}

	public function distributor() {
		return $this->belongsTo(Shop::class, 'distributor_id');
	}
	public function officer() {
		return $this->belongsTo(User::class, 'user_id');
	}

	public function teamleader() {
		return $this->belongsTo(User::class, 'teamleader_id');
	}

	public function technician() {
		return $this->belongsTo(Technician::class);
	}

	public function supportdf() {
		return $this->belongsTo(Item::class, 'item_id');
	}

	public function scopeDfProblemById($query, $id) {
		$result = $query->with([
			'region' => function ($q) {
				return $q->select('id', 'name');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			'technician' => function ($q) {
				return $q->select('id', 'name', 'mobile');
			},
			'officer' => function ($q) {
				return $q->with(['designation' => function ($dq) {
					$dq->select('id', 'short_name');
				}])
					->select('id', 'name', 'designation_id', 'mobile');
			},
		])
			->findOrFail($id);

		$complains = ComplainType::join('problem_types', 'problem_types.id', '=', 'complain_types.problem_type_id')
			->where('complain_types.df_problem_id', $id)
			->pluck('problem_types.name')
			->implode(',');

		$result->df_problem = $complains;

		return $result;
	}

	public function scopeDfProblemForSms($query, $id) {
		$result = $query->join('depots', 'depots.id', '=', 'df_problems.depot_id')
			->join('zones', 'zones.id', '=', 'df_problems.region_id')
			->select(
				'df_problems.proprietor_name',
				'df_problems.token',
				'df_problems.df_code',
				'df_problems.df_size',
				'df_problems.outlet_name',
				'df_problems.mobile',
				'df_problems.address',
				'depots.name as depot',
				'depots.id as depot_id',
				'zones.name as region'
			)
			->selectRaw('date(df_problems.created_at) as created_date')
			->selectRaw('time(df_problems.created_at) as created_time')
			->findOrFail($id);

		$complains = ComplainType::join('problem_types', 'problem_types.id', '=', 'complain_types.problem_type_id')
			->where('complain_types.df_problem_id', $id)
			->pluck('problem_types.name')
			->implode(',');

		$result->df_problem = $complains;

		return $result;
	}

	public function scopeDfProblemForTechAssignedSms($query, $id) {
		$result = $query->join('depots', 'depots.id', '=', 'df_problems.depot_id')
			->join('technicians', 'technicians.id', '=', 'df_problems.technician_id')
			->join('zones', 'zones.id', '=', 'df_problems.region_id')
			->select(
				'df_problems.proprietor_name',
				'df_problems.token',
				'df_problems.df_code',
				'df_problems.df_size',
				'df_problems.outlet_name',
				'df_problems.mobile',
				'df_problems.address',
				'depots.name as depot',
				'depots.id as depot_id',
				'technicians.mobile as technician_mobile',
				'zones.name as region'
			)
			->selectRaw('date(df_problems.created_at) as created_date')
			->selectRaw('time(df_problems.created_at) as created_time')
			->findOrFail($id);

		$complains = ComplainType::join('problem_types', 'problem_types.id', '=', 'complain_types.problem_type_id')
			->where('complain_types.df_problem_id', $id)
			->pluck('problem_types.name')
			->implode(',');

		$result->df_problem = $complains;

		return $result;
	}
	public function scopeCondByDfProblemId($query, $id) {
		return $query->where('id', $id);
	}

	public function scopeGetComplainTypes($query, $id) {
		return ComplainType::join('problem_types', 'problem_types.id', '=', 'complain_types.problem_type_id')
			->where('complain_types.df_problem_id', $id)
			->pluck('problem_types.name')
			->implode(',');
	}
}
