<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Role;
use App\Stage;
use App\StageDetail;
use App\User;
use Illuminate\Http\Request;

class StagingsController extends Controller {

	private function existsApplicationInStage($module) {
		/*
			requisition module uses " Requisition model "
			return module uses " Return model "
			transfer module uses " Rransfer model "
			service module uses " DamageApplication model "
		*/
		$arr = [
			'requisition' => 'Requisition',
			'return' => 'Return',
			'damage_application' => 'DamageApplication',
		];
		$model = 'App\\' . $arr[$module];
		return $model::where(function ($query) {
			$query->where('status', 'processing')
				->orWhere('status', 'on_hold');
		})->exists();

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($module = 'requisition') {
		$stages = Stage::with(['stage_details' => function ($q) {
			return $q->with(['designation' => function ($qu) {
				return $qu->select('id', 'short_name');
			}])
				->select('id', 'stage_id', 'designation_id', 'actions');
		}])
			->where('module', $module)
			->orderBy('sequence')
			->get();
		//dd($stages->toArray());
		return view('stages.index', compact('stages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create($module = 'requisition') {
		$stageIds = Stage::where('module', $module)->pluck('id');
		$usedDesignationIds = StageDetail::whereIn('stage_id', $stageIds)->pluck('designation_id');

		$canApplyRoles = Role::where('can_apply', true)->pluck('id');
		$usersDesignationIds = User::whereIn('role_id', $canApplyRoles)->distinct()->pluck('designation_id');

		$designations = Designation::whereNotIn('id', $usedDesignationIds)
			->whereNotIn('id', $usersDesignationIds)
			->pluck('title', 'id');
		return view('stages.create', compact('designations'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $module = 'requisition') {

		$data = $request->all();
		$request->validate([
			'name' => 'required',
		]);
		$count = Stage::where('name', $data['name'])->where('module', $data['module_name'])->count();
		$maxSequence = (int) Stage::where('module', $data['module_name'])->max('sequence');

		if ($count == 1) {
			$request->validate([
				'name' => 'required|unique:stages,name,NULL,id,module,' . $module,
			]);
		}

		$stageData = [];
		$stageData['name'] = $data['name'];
		$stageData['module'] = $data['module_name'];
		$stageData['sequence'] = $maxSequence + 1;
		$stages = Stage::create($stageData);
		if ($stages) {
			$stageDetailsData = [];
			$i = 0;
			foreach ($data['data'] as $details) {
				if (isset($details['designation_id']) && isset($details['actions'])) {
					$stageDetailsData[$i]['designation_id'] = $details['designation_id'];
					$stageDetailsData[$i]['actions'] = json_encode(array_values($details['actions']));
					$i++;
				}
			}
			$stages->stage_details()->createMany($stageDetailsData);
			$message = "You have successfully created";
			return redirect()->route('stages.index', [$data['module_name']])
				->with('flash_success', $message);

		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('stages.index', [])
				->with('flash_danger', $message);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($module = 'requisition', $id) {
		$stages = Stage::with(['stage_details'])->findOrFail($id);
		$stageIds = Stage::where('module', $module)->pluck('id');
		$currentStageIdsKey = $stageIds->search($id);
		unset($stageIds[$currentStageIdsKey]);
		$usedDesignationIds = StageDetail::whereIn('stage_id', $stageIds)->pluck('designation_id');

		$canApplyRoles = Role::where('can_apply', true)->pluck('id');
		$usersDesignationIds = User::whereIn('role_id', $canApplyRoles)->distinct()->pluck('designation_id');

		$designations = Designation::whereNotIn('id', $usedDesignationIds)
			->whereNotIn('id', $usersDesignationIds)
			->pluck('title', 'id');
		return view('stages.edit', compact('stages', 'designations'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $module = 'requisition', $id) {
		$data = $request->except('_method', '_token');
		$request->validate([
			'name' => 'required|unique:stages,name,' . $id . ',id,module,' . $module,
		]);

		//new modified details data insert
		$stageDetailsData = [];
		$i = 0;
		if (!empty($data['data'])) {
			foreach ($data['data'] as $details) {
				if (isset($details['designation_id']) && isset($details['actions'])) {
					$stageDetailsData[$i]['stage_id'] = $id;
					$stageDetailsData[$i]['designation_id'] = $details['designation_id'];
					$stageDetailsData[$i]['actions'] = json_encode(array_values($details['actions']));
					$i++;
				}
			}
		}
		//stage update
		if (count($stageDetailsData) > 0) {
			//stage-details delete by stage id
			StageDetail::where('stage_id', $id)->delete();

			StageDetail::insert($stageDetailsData);
			$stages = Stage::where('id', $id)->update(['name' => $data['name']]);
		} else {
			if ($this->existsApplicationInStage($module)) {
				$message = "One or more application are waiting for complete.";
				return redirect()->route('stages.index', [$module])
					->with('flash_danger', $message);
			} else {
				Stage::destroy($id);
			}

		}

		$message = "You have successfully updated";
		return redirect()->route('stages.index', [$module])
			->with('flash_success', $message);
	}

	public function sort(Request $request, $module = 'requisition') {
		$newData = [];
		//dump($module);
		if ($request->isMethod('put')) {
			$data = $request->except('_method', '_token');
			foreach ($data['sort'] as $key => $value) {
				Stage::where('id', $value)->update(['sequence' => $key + 1]);
			}
			$message = "You have successfully updated";
			return redirect()->route('stages.index', [$module])
				->with('flash_success', $message);
		} else {
			$stages = Stage::where('module', $module)->orderBy('sequence')->pluck('name', 'id');
			return view('stages.sort', compact('stages'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($module = 'requisition', $id) {
		if ($this->existsApplicationInStage($module)) {
			$message = "One or more application are waiting for complete.";
			return redirect()->route('stages.index', [$module])
				->with('flash_danger', $message);
		} else {
			$stage = Stage::find($id);
			$stages = $stage->destroy($id);
			if ($stages) {
				$message = "You have successfully deleted";
				return redirect()->route('stages.index', [$module])
					->with('flash_success', $message);
			} else {
				$message = "Something wrong!! Please try again";
				return redirect()->route('stages.index', [$module])
					->with('flash_danger', $message);
			}
		}
	}

	//untage designation from stage details
	public function untag($module = 'requisition', $id, $stageId) {
		$count = StageDetail::where('stage_id', $stageId)->count();
		if ($count > 1) {
			$stageDetail = StageDetail::find($id);
			$stageDetails = $stageDetail->destroy($id);
		} else {
			if ($this->existsApplicationInStage($module)) {
				$message = "One or more application are waiting for complete.";
				return redirect()->route('stages.index', [$module])
					->with('flash_danger', $message);
			} else {
				$stageDetails = Stage::destroy($stageId);
			}

		}

		if ($stageDetails) {
			$message = "You have successfully untaged";
			return redirect()->route('stages.index', [$module])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('stages.index', [$module])
				->with('flash_danger', $message);
		}
	}
}
