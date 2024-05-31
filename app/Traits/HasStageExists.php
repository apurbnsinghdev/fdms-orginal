<?php

namespace App\Traits;
use App\Stage;
use App\User;

trait HasStageExists {

	private function getStageSequence($moduleName = 'requisition') {
		$authDesignationId = auth()->user()->designation_id;
		return Stage::whereExists(function ($query) use ($authDesignationId) {
			$query->select('stage_details.id')
				->from('stage_details')
				->where('stage_details.designation_id', $authDesignationId)
				->whereRaw('stage_details.stage_id = stages.id');
		})
			->where('module', $moduleName)
			->value('sequence');
	}

	private function hasInStage($moduleName = 'requisition') {
		$authDesignationId = auth()->user()->designation_id;
		return Stage::with([
			'stage_details' => function ($q) {
				return $q->select('stage_id', 'designation_id', 'actions');
			},
		])
			->whereExists(function ($query) use ($authDesignationId) {
				$query->select('stage_details.id')
					->from('stage_details')
					->where('stage_details.designation_id', $authDesignationId)
					->whereRaw('stage_details.stage_id = stages.id');
			})
			->where('module', $moduleName)
			->first();
	}

	private function getStageWithActionsAndSequence($moduleName = 'requisition') {
		$authDesignationId = auth()->user()->designation_id;
		$actionsArr = collect([]);
		$stageSequence = 'NULL';
		$stages = $this->hasInStage($moduleName);
		if ($stages) {
			$stageSequence = $stages->sequence;
			if ($stages->stage_details) {
				if ($objj = $stages->stage_details->firstWhere('designation_id', $authDesignationId)) {
					$actionsArr = collect(json_decode($objj->actions));
				}
			}
		}
		return ['actions' => $actionsArr, 'sequence' => $stageSequence];
	}
	
	//check in-charge as ASM  for executuve group  for the first stage['requisition']
	private function checkFirstStageSupervisor($distributorId,$moduleName='requisition'){
	    $stages = Stage::with(['stage_details'=>function($q){
	        return $q->select('stage_id','designation_id');
	    }])
	    ->where('sequence',1)
	    ->where('module',$moduleName)
	    ->select('id')
	    ->first();
	    $designationIds = $stages->stage_details->pluck('designation_id');
	    return  User::join('distributor_users','distributor_users.user_id','=','users.id')
	    ->where('distributor_users.distributor_id',$distributorId)
	    ->whereIn('users.designation_id',$designationIds)
	    ->exists();
	    
	}

}