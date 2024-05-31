<?php

namespace App\Http\Controllers;
use App\DfReturnLog;
use App\Location;
use App\RequisitionLog;
use App\Shop;
use App\SmsPromotional;
use App\Traits\AjaxForInventory;
use App\Traits\AjaxForReport;
use App\Traits\AjaxForRequisition;
use App\Traits\AjaxForReturn;
use App\Traits\AjaxForService;
use App\Zone;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AjaxController extends Controller {
	use AjaxForInventory, AjaxForRequisition, AjaxForService, AjaxForReturn, AjaxForReport;

	public function __construct() {
		parent::__construct();
	}

	public function getDistricts(Request $request) {
		$pid = $request->division_id;
		if (!empty($pid)) {
			return Location::where('parent_id', $pid)->get()->pluck('name', 'id');
		} else {
			return collect([]);
		}

	}
	public function getThanas(Request $request) {
		$pid = $request->district_id;
		if (!empty($pid)) {
			return Location::where('parent_id', $pid)->get()->pluck('name', 'id');
		} else {
			return collect([]);
		}
	}
	public function getAreas(Request $request) {
		$pid = $request->region_id;
		if (!empty($pid)) {
			return Zone::where('parent_id', $pid)->get()->pluck('name', 'id');
		} else {
			return collect([]);
		}
	}

	//for requisition and return module
	public function stageActionOparation($id, $actionName, $stage, $module = 'requisition') {
		$requisitions = (object) [];
		if ($actionName == 'validate' && $module == 'requisition') {
			$requisitions = \App\Requisition::select(
				'last_three_months_avg_sales',
				'average_sales',
				'last_three_months_avg_sales_real',
				'average_sales_real'
			)
				->find($id);
		}
		return view('ajax.action_operation_common', compact('id', 'actionName', 'stage', 'module', 'requisitions'));
	}

	//for requisition and return module
	public function saveStageAction(Request $request, $module = 'requisition') {
		$data = $request->all();
		$action = $data['action'];
		$methodName = $module . '_' . $action;
		if ($action == 'hold' || $action == 'cancel') {
			$validator = \Validator::make($data, [
				'comments' => 'required|max:150',
			]);

			if ($validator->fails()) {
				return response()->json([
					'error' => true,
					'success' => true,
					'message' => 'Comments can not be blank.',
				]);
			}
		}

		if (!empty($data['comments'])) {
			$parent_id = 'requisition_id';
			if ($module == 'return') {
				$parent_id = 'df_return_id';
			}
			$logData[$parent_id] = $data['id'];
			$logData['stage'] = $data['stage'];
			$logData['action_name'] = $action;
			$logData['user_id'] = auth()->user()->id;
			$logData['comments'] = $data['comments'];
			if ($module == 'return') {
				DfReturnLog::create($logData);
			} else {
				RequisitionLog::create($logData);
			}

		}
		return $this->$methodName($request);
	}

	public function continueList($param) {
		$amount = 0;
		$dat = 0;
		if (date("d") >= 15) {
			$dat = 1;
		}
		if ($param == 'without_rent') {
			$oparator = '=';
			$months = 'settlements.inject_date';
		} else {
			$oparator = '>';
			$months = 'settlements.month_from';
		}

		$query = \App\Settlement::select(
			'settlements.id',
			'settlements.item_id',
			'settlements.shop_id',
			'settlements.requisition_id',
			'settlements.receive_amount',
			'settlements.installment',
			'settlements.inject_date',
			'settlements.month_from',
			'settlements.month_to',
			'settlements.closed_date',
			'shops.outlet_name',
			'items.serial_no as df_code',
			'distributors.outlet_name as distributor',
			'depots.name as depot'
		)
			->selectRaw("IF(settlements.status = 'reserve','reserved','continue') as status")
			->selectRaw("PERIOD_DIFF( DATE_FORMAT(CURDATE(), '%Y%m') , DATE_FORMAT($months, '%Y%m') )+$dat AS usedMonths")
			->selectRaw("CAST(settlements.receive_amount as SIGNED) - CAST((PERIOD_DIFF( DATE_FORMAT(CURDATE(), '%Y%m') , DATE_FORMAT($months, '%Y%m') )+$dat)*settlements.installment as SIGNED) AS dueAmount")
			->whereIn('settlements.status', ['continue', 'reserve'])
			->where('settlements.receive_amount', $oparator, $amount)
			->join('shops', 'shops.id', '=', 'settlements.shop_id')
			->join('shops as distributors', 'distributors.id', '=', 'shops.distributor_id')
			->join('items', 'items.id', '=', 'settlements.item_id')
			->join('depots', 'depots.id', '=', 'shops.depot_id')
			->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
			->where('distributor_users.user_id', auth()->user()->id)
			->orderBy('settlements.inject_date', 'desc');

		return app('datatables')::of($query)
			->filterColumn('settlements.status', function ($q, $keyword) {
				if ($keyword == 'reserved') {
					$q->where('settlements.status', 'reserve');
				} else {

					$sql = "settlements.status  like ?";
					$q->whereRaw($sql, ["%{$keyword}%"]);
				}
			})
			->make(true);

	}

	public function closedList($param) {
		$query = \App\Settlement::select(
			'settlements.id',
			'settlements.item_id',
			'settlements.shop_id',
			'settlements.requisition_id',
			'settlements.receive_amount',
			'settlements.installment',
			'settlements.inject_date',
			'settlements.month_from',
			'settlements.month_to',
			'settlements.closed_date',
			'settlements.payable_amount',
			'settlements.paid_amount',
			'settlements.paid_date',
			'shops.outlet_name',
			'items.serial_no as df_code',
			'distributors.outlet_name as distributor',
			'depots.name as depot'
		)
			->whereIn('settlements.status', ['closed', 'replace'])
			->selectRaw("IF(settlements.status = 'replace','replaced','closed') as status")
			->selectRaw("PERIOD_DIFF( DATE_FORMAT(IF(DAY(settlements.closed_date)>15,DATE_ADD(settlements.closed_date,INTERVAL 1 MONTH),settlements.closed_date), '%Y%m') , DATE_FORMAT(IF(settlements.month_from IS NULL,settlements.inject_date,settlements.month_from), '%Y%m') ) AS usedMonths")
			->join('shops', 'shops.id', '=', 'settlements.shop_id')
			->join('shops as distributors', 'distributors.id', '=', 'shops.distributor_id')
			->join('items', 'items.id', '=', 'settlements.item_id')
			->join('depots', 'depots.id', '=', 'shops.depot_id')
			->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
			->where('distributor_users.user_id', auth()->user()->id)
			->orderBy('settlements.closed_date', 'desc');

		if ($param == 'payable') {
			$query->where('settlements.paid_amount', 0)
				->where('settlements.payable_amount', '>', 0);
		} else if ($param == 'paid') {
			$query->where('settlements.paid_amount', '>', 0);
		}
		//return datatables($query)->make(true);
		return app('datatables')::of($query)
			->filterColumn('settlements.status', function ($q, $keyword) {
				if ($keyword == 'replaced') {
					$q->where('settlements.status', 'replace');
				} else {

					$sql = "settlements.status  like ?";
					$q->whereRaw($sql, ["%{$keyword}%"]);
				}
			})
			->make(true);
	}

	public function uploadProfilePicture(Request $request) {
		$request->validate([
			'avatar' => 'mimes:jpeg,jpg,png|max:1024',
		]);

		$user = \App\User::find(auth()->id());
		$old_image = $user->avatar;
		$upload = $request->file('avatar');
		$directory = '../public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR;
		$fileName = time() . '_avatar.' . $upload->getClientOriginalExtension();
		$imageUrl = $directory . $fileName;
		$imgUploaded = Image::make($upload);
		if ($imgUploaded) {
			$imgUploaded->resize(300, 300)->save($imageUrl);
			$userObj = $user->update(['avatar' => $fileName]);
			if ($userObj) {
				if ($old_image) {
					\Storage::delete('/images/avatar/' . $old_image);
				}
				$message = "You have successfully uploaded";
				return redirect()->route('users.show')->with('flash_success', $message);
			} else {
				$message = "Something wrong!! Please try again";
				return redirect()->route('users.show')->with('flash_danger', $message);
			}

		} else {
			$message = "Image can't be processed!! Please upload another";
			return redirect()->route('users.show')->with('flash_danger', $message);
		}

	}

	//promotional sms list
	public function getPromotionalSmsWithPaginate($param = 'sales_team') {
		$query = SmsPromotional::join('users', 'sms_promotionals.user_id', '=', 'users.id')
			->select('sms_promotionals.id', 'sms_promotionals.subject', 'sms_promotionals.message', 'sms_promotionals.type', 'sms_promotionals.created_at', 'users.name')
			->where('type', $param)
			->orderBy('sms_promotionals.created_at', 'desc')
			->get();
		return datatables($query)->make(true);
	}

	//distributors index  for every user
	public function getDistributorsWithPaginate() {

		$query = Shop::with([
			'region' => function ($q) {
				return $q->select('id', 'name');
			},
			'area' => function ($q) {
				return $q->select('id', 'name');
			},
			'district' => function ($q) {
				return $q->select('id', 'name');
			},
			'thana' => function ($q) {
				return $q->select('id', 'name');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
		])
			->select('shops.id', 'shops.outlet_name', 'shops.proprietor_name', 'shops.is_distributor', 'shops.distributor_id', 'shops.mobile', 'shops.depot_id', 'shops.region_id', 'shops.area_id', 'shops.district_id', 'shops.thana_id', 'shops.code', 'shops.status')
			->withCount('retailers')
			->where('shops.is_distributor', true)
			->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.id')
			->where('distributor_users.user_id', auth()->user()->id)
			->orderBy('shops.updated_at', 'desc');

		return datatables($query)->make(true);
	}
}
