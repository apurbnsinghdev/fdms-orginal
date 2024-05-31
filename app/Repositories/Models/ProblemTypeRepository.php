<?php
namespace App\Repositories\Models;

use App\ProblemType;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class ProblemTypeRepository extends Repository {

	// model property on class instances
	//protected $model;

	// Constructor to bind model to repo
	public function __construct() {
		$dfProblem = new ProblemType;
		parent::__construct($dfProblem);
	}

	// Get all instances of model
	public function all() {
		return $this->model->all();
	}

	public function getProblemTypesInProblems() {

		$problems = $this->model
			->join('df_problems', 'df_problems.problem_type_id', '=', 'problem_types.id')
			->select('problem_types.id', 'problem_types.name')
			->groupBy(['problem_types.id'])
			->pluck('name', 'id');

		return $problems;

	}

}
