<?php

namespace App\Traits;
use App\DamageApplication;
use App\DepotUser;
use App\DfProblem;
use App\Item;
use App\Traits\HasStageExists;
use App\Traits\SettlementCreateCloseData;
use Illuminate\Http\Request;

trait DamageApplicationTrait {
    use HasStageExists,SettlementCreateCloseData;

	public function applyForDamage(Request $request) {
		$data = $request->all();
		$request->validate([
			'damage_type_id' => 'required',
			'remarks' => 'required',
		]);
		$itemObj = Item::where(['serial_no' => $data['df_code']])->select('id','freeze_status')->first();
		if (!$itemObj) {
			$message = "Item does not match. Please try by another item.";
			return redirect()->route('services.problemEntryEdit', [$data['df_problem_id']])
				->with('flash_danger', $message);
		}
		$itemId = $itemObj->id;
		$saveData = $data;
		$saveData['item_id'] = $itemId;
		$saveData['stage'] = 1;
		$damageApplication = DamageApplication::create($saveData);
		if ($damageApplication) {
		    //update item status for damage application
		    $itemObj->update(['freeze_status'=>'damage_applied']);
		    //settlement
			$this->updateSettleMent(['item_id' => $itemId, 'shop_id' => $data['shop_id'], 'status' => 'continue'],['damage_application_id' => $damageApplication->id]);
			DfProblem::where('id', $data['df_problem_id'])->update(['status' => 'applied_for_damage']);
			$message = "You have successfully applied";
			return redirect()->route('services.problemEntryList', ['new'])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('services.problemEntryEdit', [$data['df_problem_id']])
				->with('flash_danger', $message);
		}

	}

	public function damageApplicationList($param = null) {

		$authDepotIds = DepotUser::where('user_id', auth()->id())->pluck('depot_id');

		// check existance in stage for auth user
		$stageArr = $this->getStageWithActionsAndSequence('damage_application');
		$stageSequence = $stageArr['sequence'];
		$actionsArr = $stageArr['actions'];
		// get stage actions for auth user

		$queryObj = DamageApplication::with([
			'item' => function ($q) {
				return $q->select('id', 'serial_no');
			},
			'settlement' => function ($s) {
				return $s->select('item_id', 'inject_date');
			},
			'depot' => function ($s) {
				return $s->select('id', 'name');
			},
			'shop' => function ($s) {
				return $s->select('id', 'outlet_name');
			},
			'damage_type',

		])
			->whereIn('depot_id', $authDepotIds);

		if ($param == 'new') {
			$queryObj->where('status', 'processing')
				->where('stage', $stageSequence);
		} elseif ($param == 'processing') {
			$queryObj->where('status', 'processing')
				->where('stage', '<>', $stageSequence);
		} else {
			$queryObj->where('status', $param);
		}

		$applications = $queryObj->orderBy('created_at', 'desc')->limit(100)->get();
		//dump($applications->toArray());
		//dump($actionsArr);
		return view('services.damage_applications.index', compact('param', 'applications', 'stageSequence', 'actionsArr'));
	}

}
