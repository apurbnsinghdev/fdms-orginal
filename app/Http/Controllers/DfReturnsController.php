<?php

namespace App\Http\Controllers;

use App\DfReturn;
use App\Role;
use App\Shop;
use App\Traits\HasStageExists;
use App\Traits\SettlementCreateCloseData;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DfReturnsController extends Controller {

	use SettlementCreateCloseData, HasStageExists;

	public function index($param = 'new') {
		if ($param == 'new') {
			$params = 'processing';
		} else {
			$params = $param;
		}

		$dfReturnObj = DfReturn::with([
			'creator' => function ($q) {
				return $q->select('id', 'name');
			},
			'shop' => function ($q) {
				return $q->select('id', 'outlet_name');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			'currentdf' => function ($q) {
				return $q->select('id', 'serial_no');
			},
			'stager' => function ($q) {
				return $q->select('id', 'name');
			},
			'to_outlet' => function ($q) {
				return $q->select('id', 'outlet_name');
			},
		])
			->select('df_returns.id', 'df_returns.user_id', 'df_returns.stage', 'df_returns.shop_id', 'df_returns.depot_id', 'df_returns.current_df', 'df_returns.return_reason', 'df_returns.withdrawal_date', 'df_returns.to_shop', 'df_returns.action_by', 'df_returns.is_requisition_created')
			->where('df_returns.status', $params)
			->orderBy('df_returns.updated_at', 'desc');

		$isExecutiveGroup = Role::where('id', auth()->user()->role_id)->value('can_apply');

		if (!$isExecutiveGroup) {
			$isExecutive = false;
			// check existance in stage for auth user
			$stageArr = $this->getStageWithActionsAndSequence('return');
			$stageSequence = $stageArr['sequence'];
			$actionsArr = $stageArr['actions'];
			// get stage actions for auth user

			$dfReturnObj->join('depot_users', 'depot_users.depot_id', '=', 'df_returns.depot_id')
				->where('depot_users.user_id', auth()->user()->id);

			if ($param == 'new') {
				$dfReturnObj->where('df_returns.stage', $stageSequence);
			} else if ($param == 'processing') {
				$dfReturnObj->where('df_returns.stage', '<>', $stageSequence);
			} else if ($param == 'completed') {
				$dfReturnObj->take(50);
			}

		} else {
			$isExecutive = true;
			$actionsArr = collect([]);
			$dfReturnObj->where('user_id', auth()->id());
			if ($param == 'new') {
				$dfReturnObj->whereNull('action_by');
			} else if ($param == 'processing') {
				$dfReturnObj->whereNotNull('action_by');
			}
		}

		$dfreturns = $dfReturnObj->get();
		//dd($dfreturns->toArray());

		return view('df_returns.index', compact('dfreturns', 'param', 'isExecutive', 'actionsArr'));
	}

	private function storeApply($request) {
		$data = $request->all();
		$data['user_id'] = auth()->id();
		//dd($data);
		$currentDate = date("Y-m-d");
		$validateData = [];
		$validateData['shop_id'] = 'required';
		$validateData['current_df'] = 'required';
		$validateData['withdrawal_date'] = 'required|date|after_or_equal:'. $currentDate;
		$toShopId = 0;
		if (isset($data['is_transfer_to_shop'])) {
			$validateData['distributor_id'] = 'required';
			$validateData['to_shop'] = 'required';
			$toShopId = $data['to_shop'];
		}
		$request->validate($validateData);

		$data['withdrawal_date'] = Carbon::parse($data['withdrawal_date'])->format('Y-m-d');
		$data['depot_id'] = Shop::where('id', $data['shop_id'])->value('depot_id');

		$sattlementObj = (object) ['shop_id' => $data['shop_id'], 'current_df' => $data['current_df']];
		if ($returnObj = $this->settlementLockUnlock($sattlementObj)) {
			return $returnObj;
		}
		$dfreturns = DfReturn::create($data);
		if ($dfreturns) {
			if (!empty($toShopId)) {
				$message = "Return application successfully done. Please proceed for transfer requisition.";
				return redirect()->route('requisitions.create', [$toShopId])
					->with('flash_info', $message);
			} else {
				$message = "You have successfully created";
				return redirect()->route('returns.index', [])
					->with('flash_success', $message);
			}
		} else {
			//if not settlement table again continue
			$this->settlementLockUnlock($sattlementObj, true);
			$message = "Something wrong!! Please try again";
			return redirect()->route('returns.index', [])
				->with('flash_danger', $message);
		}
	}

	public function apply(Request $request) {
		$isExecutiveGroup = Role::where('id', auth()->user()->role_id)->value('can_apply');
		if (!$isExecutiveGroup) {
			$message = "Only can apply Field Sales Group!";
			return redirect()->route('returns.index', [])
				->with('flash_danger', $message);
		}
		if ($request->isMethod('post')) {
			return $this->storeApply($request);
		} else {
			$distributors = Shop::where('is_distributor', true)
				->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.id')
				->where('distributor_users.user_id', auth()->id())
				->pluck('shops.outlet_name', 'shops.id')
				->prepend('Please Select Distributo', '');

			$shops = Shop::where('is_distributor', false)
				->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
				->where('distributor_users.user_id', auth()->id())
				->select('shops.id')
				->selectRaw("CONCAT(shops.outlet_name,' (',shops.mobile,')') as outlet_name")
				->orderBy('shops.outlet_name')
				->pluck('outlet_name', 'shops.id')
				->prepend('Please Select Shop', '');

			return view('df_returns.apply', compact('shops', 'distributors'));

		}

	}

}
