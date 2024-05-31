<?php

namespace App\Traits;
use App\DfReturn;
use App\Requisition;
use App\RequisitionLog;
use App\Shop;
use App\Stage;
use App\Traits\HasStageExists;
use App\Traits\SettlementCreateCloseData;

trait AjaxForReturn {
	use HasStageExists, SettlementCreateCloseData;

	public function getDistributorShops($distributor_id, $from_shop_id) {
		$shopList = Shop::where('distributor_id', $distributor_id)
			->where('id', '<>', $from_shop_id)
			->select('id')
			->selectRaw("CONCAT(outlet_name,' (',mobile,')') as outlet_name")
			->orderBy('outlet_name')
			->pluck('outlet_name', 'id')
			->prepend('Please Select Shop', '');
		return view('ajax.get_distributor_shops', compact('shopList'));
	}

	//requisition cancelled for df return cancelled if return df transfer to other shop
	private function requisition_cancel_from_return($dfReturnId) {
		$requisitionObj = Requisition::where('df_return_id', $dfReturnId)
			->where('status', '<>', 'draft')
			->select('id', 'type', 'shop_id', 'current_df', 'action_by', 'stage_status', 'status', 'stage')
			->first();
		if ($requisitionObj->type == 'replace') {
			//inserted current df will be unlock
			$this->settlementLockUnlock($requisitionObj, true);
		}

		$requisition = $requisitionObj->update([
			'action_by' => auth()->user()->id,
			'stage_status' => 'cancelled',
			'status' => 'cancelled',
		]);
		$logData['requisition_id'] = $requisitionObj->id;
		$logData['stage'] = $requisitionObj->stage;
		$logData['action_name'] = 'cancelled';
		$logData['user_id'] = auth()->user()->id;
		$logData['comments'] = 'Cancelled for df return cancelled';
		RequisitionLog::create($logData);
	}
	private function return_cancel($request) {
		$data = $request->all();
		$dfReturnObj = DfReturn::find($data['id']);
		$settlementError = $this->settlementLockUnlock($dfReturnObj, true);
		if ($settlementError) {
			return response()->json([
				'error' => true, 'success' => false,
				'message' => 'Opps! Can not find settlement data.',
			]);
		}
		$dfReturn = $dfReturnObj->update([
			'action_by' => auth()->user()->id,
			'status' => 'cancelled',
		]);
		if ($dfReturn) {
			if ($dfReturnObj->is_requisition_created) {
				$this->requisition_cancel_from_return($data['id']);
			}
			return response()->json([
				'error' => false,
				'success' => true,
				'message' => 'Action has successfully done',
			]);
		} else {
			$this->settlementLockUnlock($dfReturnObj);
			return response()->json([
				'error' => true, 'success' => false,
				'message' => 'Opps! Something error. Please try again.',
			]);
		}
	}

	private function return_hold($request) {
		$data = $request->all();

		$dfReturn = DfReturn::where('id', $data['id'])
			->update([
				'action_by' => auth()->user()->id,
				'status' => 'on_hold',
			]);
		if ($dfReturn) {
			return response()->json([
				'error' => false,
				'success' => true,
				'message' => 'Action has successfully done',
			]);
		} else {
			return response()->json([
				'error' => true,
				'success' => false,
				'message' => 'Opps! Something error. Please try again.',
			]);
		}
	}

	private function return_approve($request) {
		$data = $request->all();
		$returnStage = $data['stage'];
		$maxStageSeq = Stage::where('module', 'return')
			->max('sequence');

		$returnObj = DfReturn::find($data['id']);
		if ($returnStage < $maxStageSeq) {
			$dfReturn = $returnObj->update([
				'action_by' => auth()->user()->id,
				'status' => 'processing',
				'stage' => $data['stage'] + 1,
			]);

		} else {
			//settlement close for return df
			$errorRetur = $this->settlementClose($returnObj, 'closed');
			if ($errorRetur) {
				return response()->json([
					'error' => true,
					'success' => false,
					'message' => 'Opps! Can not find settlement data.',
				]);
			}
			$dfReturn = $returnObj->update([
				'action_by' => auth()->user()->id,
				'status' => 'completed',
			]);
		}

		if ($dfReturn) {
			return response()->json([
				'error' => false,
				'success' => true,
				'message' => 'Action has successfully done',
			]);
		} else {
			$this->settlementLockUnlock($returnObj, true);
			return response()->json([
				'error' => true,
				'success' => false,
				'message' => 'Opps! Something error. Please try again.',
			]);
		}

	}
}
