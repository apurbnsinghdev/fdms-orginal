<?php
namespace App\Repositories\Models;

use App\ComplainType;
use App\DfProblem;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class DfProblemRepository extends Repository {

	// model property on class instances
	//protected $model;

	// Constructor to bind model to repo
	public function __construct() {
		$dfProblem = new DfProblem;
		parent::__construct($dfProblem);
	}

	// Get all instances of model
	public function all() {
		return $this->model->all();
	}

	public function findToken($token, $depots = []) {
		$dfproblems = $this->model::join('distributor_users', 'distributor_users.distributor_id', '=', 'df_problems.distributor_id')
			->where('distributor_users.user_id', auth()->id())
			->where('token', $token)
			->whereIn('depot_id', $depots)
			->select('df_problems.*')
			->first();

		if ($dfproblems) {
			$complains = ComplainType::join('problem_types', 'problem_types.id', '=', 'complain_types.problem_type_id')
				->where('complain_types.df_problem_id', $dfproblems->id)
				->pluck('problem_types.name')
				->implode(',');
			$dfproblems->df_problem = $complains;
		}
		return $dfproblems;
	}

	// Get all instances of model
	public function getTokens($depots) {
		return $this->model::whereIn('depot_id', $depots)
			->join('depots', 'depots.id', '=', 'df_problems.depot_id')
			->select('df_problems.token', 'depots.name')
			->get();
	}

	public function getDfWiseComplains($start_date, $end_date, $regionIds = [], $depotIds = [], $codeIds = [], $typeIds = []) {

		$start_date = Carbon::parse($start_date)->format('Y-m-d');
		$end_date = Carbon::parse($end_date)->format('Y-m-d');

		$problems = $this->model
			->groupBy(['df_problems.df_code', 'complain_types.problem_type_id'])
			->select('df_problems.df_code', 'complain_types.problem_type_id')
			->selectRaw('count(complain_types.problem_type_id) as no_of_problem')
			->whereRaw('DATE(df_problems.created_at) between ? AND ?', [$start_date, $end_date])
			->where('df_problems.df_code', '<>', 'personal');

		if ($codeIds) {
			$problems->whereIn('df_problems.df_code', $codeIds);
		}

		if ($regionIds) {
			$problems->whereIn('df_problems.region_id', $regionIds);
		}
		if ($depotIds) {
			$problems->whereIn('df_problems.depot_id', $depotIds);
		}

		$problems->join('distributor_users', 'distributor_users.distributor_id', '=', 'df_problems.distributor_id')
			->join('complain_types', 'complain_types.df_problem_id', '=', 'df_problems.id')
			->where('distributor_users.user_id', auth()->id());

		if ($typeIds) {
			$problems->whereIn('complain_types.problem_type_id', $typeIds);
		}

		return $problems->get();

	}

	public function getDfSizeWiseComplains($years = [], $months = [], $regionIds = [], $depotIds = [], $sizes = []) {

		$dfProblems = $this->model
			->groupBy(['year', 'month', 'df_size'])
			->select('df_size')
			->selectRaw('count(df_problems.id) as no_of_problem')
			->selectRaw('year(created_at) as year')
			->selectRaw('month(created_at) as month');
		if ($years) {
			$dfProblems->whereIn(\DB::raw('year(created_at)'), $years);
		}
		if ($months) {
			$dfProblems->whereIn(\DB::raw('month(created_at)'), $months);
		}
		if ($regionIds) {
			$dfProblems->whereIn('region_id', $regionIds);
		}
		if ($depotIds) {
			$dfProblems->whereIn('depot_id', $depotIds);
		}
		if ($sizes) {
			$dfProblems->whereIn('df_size', $sizes);
		}

		$dfProblems->join('distributor_users', 'distributor_users.distributor_id', '=', 'df_problems.distributor_id')
			->where('distributor_users.user_id', auth()->id());
		return $dfProblems->get();

	}

	public function getTypeWiseComplains($years = [], $months = [], $regionIds = [], $depotIds = [], $typeIds = []) {

		$problems = $this->model
			->groupBy(['year', 'month', 'complain_types.problem_type_id'])
			->select('complain_types.problem_type_id')
			->selectRaw('count(complain_types.problem_type_id) as no_of_problem')
			->selectRaw('year(df_problems.created_at) as year')
			->selectRaw('month(df_problems.created_at) as month');

		if ($years) {
			$problems->whereIn(\DB::raw('year(df_problems.created_at)'), $years);
		}
		if ($months) {
			$problems->whereIn(\DB::raw('month(df_problems.created_at)'), $months);
		}
		if ($regionIds) {
			$problems->whereIn('df_problems.region_id', $regionIds);
		}
		if ($depotIds) {
			$problems->whereIn('df_problems.depot_id', $depotIds);
		}
		$problems->join('distributor_users', 'distributor_users.distributor_id', '=', 'df_problems.distributor_id')
			->join('complain_types', 'complain_types.df_problem_id', '=', 'df_problems.id')
			->where('distributor_users.user_id', auth()->id());

		if ($typeIds) {
			$problems->whereIn('complain_types.problem_type_id', $typeIds);
		}
		return $problems->get();

	}

	public function getDateWiseComplains($start_date, $end_date, $regionIds = [], $depotIds = [], $typeIds = []) {
		$start_date = Carbon::parse($start_date)->format('Y-m-d');
		$end_date = Carbon::parse($end_date)->format('Y-m-d');
		$dfProblems = $this->model
			->groupBy(['dt', 'df_size'])
			->orderBy('dt', 'desc')
			->select('df_size')
			->selectRaw('count(df_problems.id) as no_of_problem')
			->selectRaw('DATE_FORMAT(df_problems.created_at,"%m/%d/%Y") as dt')
			->whereRaw('DATE(df_problems.created_at) between ? AND ?', [$start_date, $end_date]);
		if ($regionIds) {
			$dfProblems->whereIn('df_problems.region_id', $regionIds);
		}
		if ($depotIds) {
			$dfProblems->whereIn('df_problems.depot_id', $depotIds);
		}

		$dfProblems->join('distributor_users', 'distributor_users.distributor_id', '=', 'df_problems.distributor_id')
			->join('complain_types', 'complain_types.df_problem_id', '=', 'df_problems.id')
			->where('distributor_users.user_id', auth()->id());

		if ($typeIds) {
			$dfProblems->whereIn('complain_types.problem_type_id', $typeIds);
		}

		return $dfProblems->get();

	}

	public function getLongPendingComplains($depotIds = []) {
		$dfProblems = $this->model
			->select('df_problems.id', 'df_problems.token', 'df_problems.df_code', 'df_problems.df_size', 'df_problems.region_id', 'df_problems.depot_id', 'df_problems.outlet_name', 'df_problems.comments', 'df_problems.status')
			->where('df_problems.status', 'pending')
			->selectRaw('DATEDIFF(curdate(), Date(df_problems.created_at)) as duration')
			->whereRaw('DATEDIFF(curdate(), Date(df_problems.created_at)) > 3');

		if ($depotIds) {
			$dfProblems->whereIn('df_problems.depot_id', $depotIds);
		}

		$dfProblems->join('distributor_users', 'distributor_users.distributor_id', '=', 'df_problems.distributor_id')
			->where('distributor_users.user_id', auth()->id());

		$dfProblems->with([
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			'region' => function ($q) {
				return $q->select('id', 'name');
			},
			'complain_types' => function ($q) {
				return $q->with('problem_type')
					->select('df_problem_id', 'problem_type_id');
			},
		]);

		return $dfProblems->get();
	}

	public function getDamageList() {
		//$start_date = Carbon::parse($start_date)->format('Y-m-d');
		//$end_date = Carbon::parse($end_date)->format('Y-m-d');
		$damageApplication = $this->model
			->join('shops', 'shops.id', '=', 'damage_applications.shop_id')
			->select('damage_applications.id', 'shops.outlet_name')
			->join('depot_users', 'depot_users.depot_id', '=', 'damage_applications.depot_id')
			->where('depot_users.user_id', auth()->id());

		return $damageApplication->get();

	}

	public function getJobCard($start_date, $end_date, $regionIds = [], $depotIds = [], $technicianIds = []) {

		$start_date = Carbon::parse($start_date)->format('Y-m-d');
		$end_date = Carbon::parse($end_date)->format('Y-m-d');

		$dfProblems = $this->model
			->select('depot_id', 'technician_id')
			->selectRaw('sum(case when status = "completed" then DATEDIFF(Date(done_date), Date(attain_date)) else DATEDIFF(curdate(), Date(attain_date)) end) as working_days')
			->selectRaw('sum(case when status = "completed" then 1 else 0 end) as no_of_completed')
			->selectRaw('sum(case when status <> "completed" then 1 else 0 end) as no_of_assigned')
			->selectRaw('month(created_at) as month')
			->whereRaw('DATE(created_at) between ? AND ?', [$start_date, $end_date])
			->whereRaw('attain_date is not null')
			->groupBy(['depot_id', 'technician_id', 'month']);

		if ($regionIds) {
			$dfProblems->whereIn('region_id', $regionIds);
		}

		if ($depotIds) {
			$dfProblems->whereIn('depot_id', $depotIds);
		}

		if ($technicianIds) {
			$dfProblems->whereIn('technician_id', $technicianIds);
		}

		$dfProblems->join('distributor_users', 'distributor_users.distributor_id', '=', 'df_problems.distributor_id')
			->where('distributor_users.user_id', auth()->id());

		$dfProblems->with([
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			'technician' => function ($q) {
				return $q->select('id', 'name', 'mobile');
			},

		]);

		return $dfProblems->get();
	}

}
