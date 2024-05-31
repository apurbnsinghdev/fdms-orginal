<?php

namespace App\Traits;
use App\ComplainType;
use App\DamageApplication;
use App\Depot;
use App\DepotUser;
use App\DfProblem;
use App\DistributorUser;
use App\Item;
use App\ProblemType;
use App\Shop;
use App\Stage;
use Illuminate\Http\Request;

trait AjaxForService {
	private function authDistributorLists() {
		return DistributorUser::where('user_id', auth()->id())->pluck('distributor_id');
	}
	public function getItemsForService() {
		$query = Item::with(['problems' => function ($q) {
			return $q->whereNotIn('status', ['completed', 'rejected'])->select('df_code', 'token');
		}])
			->join('sizes', 'sizes.id', '=', 'items.size_id')
			->join('depots', 'depots.id', '=', 'items.depot_id')
		// ->leftJoin('df_problems', function ($join) {
		// 	$join->on('df_problems.df_code', '=', 'items.serial_no')
		// 		->whereIn('df_problems.status', ['pending', 'processing']);
		// })
			->join('shops', 'shops.id', '=', 'items.shop_id')
			->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
			->where('distributor_users.user_id', auth()->id())
			->where('items.item_status', 'continue')
			->select(
				'items.id',
				'items.serial_no',
				'shops.outlet_name',
				'shops.proprietor_name',
				'shops.mobile',
				//'df_problems.status as problem',
				'depots.name as depot',
				'sizes.name as size'
			)
			->orderBy('items.updated_at', 'desc');

		//return $query->get()->toArray();

		return datatables($query)->make(true);
	}

	public function getItemsForServiceHistory() {

		$dfProblem = DfProblem::select('df_code')->groupBy('df_code');

		$query = Item::join('sizes', 'sizes.id', '=', 'items.size_id')
			->join('depots', 'depots.id', '=', 'items.depot_id')
			->joinSub($dfProblem, 'problems', function ($join) {
				$join->on('problems.df_code', '=', 'items.serial_no');
			})
			->join('shops', 'shops.id', '=', 'items.shop_id')
			->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
			->where('distributor_users.user_id', auth()->id())
			->select(
				'items.id',
				'items.serial_no',
				'shops.outlet_name',
				'shops.proprietor_name',
				'shops.mobile',
				'depots.name as depot',
				'sizes.name as size'
			)
			->orderBy('items.updated_at', 'desc');

		//return $query->toSql();

		return datatables($query)->make(true);
	}

	public function getItemDetailsBySeraial(Request $request) {
		$serial = $request->get('serial');
		$depot_id = null;
		$distributors = collect([]);
		$depots = collect([]);
		if ($serial == 'personal') {
			$depotIds = DepotUser::where('user_id', auth()->id())->pluck('depot_id');
			if ($depotIds->count() == 1) {
				$depot_id = $depotIds[0];
			} else {
				$depots = Depot::whereIn('id', $depotIds)->pluck('name', 'id');
			}

			$distributors = Shop::where('depot_id', $depotIds[0])
				->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.id')
				->where('distributor_users.user_id', auth()->id())
				->pluck('shops.outlet_name', 'shops.id');

			$problemTypes = ProblemType::pluck('name', 'id');
			return view('ajax.personal_problem_entry_form', compact('problemTypes', 'depot_id', 'distributors', 'depots'));
		} else {
			$item = Item::with([
				'shop' => function ($q) {
					return $q->select('id', 'outlet_name', 'proprietor_name', 'mobile', 'region_id', 'address', 'is_distributor', 'distributor_id');
				},
				'size' => function ($q) {
					return $q->select('id', 'name');
				},
				'depot' => function ($q) {
					return $q->select('id', 'name');
				},
			])
				->where('serial_no', $serial)
				->select('id', 'serial_no', 'shop_id', 'size_id', 'depot_id', 'brand_id')
				->first();

			if ($item) {
				$error = false;
				$problemTypes = ProblemType::pluck('name', 'id');
			} else {
				$problemTypes = '';
				$error = true;
			}
			return view('ajax.problem_entry_form', compact('item', 'problemTypes', 'error', 'serial'));
		}
		//return $data;
	}

	public function getProblemEntries($param) {
		$query = DfProblem::with([
			'region' => function ($q) {
				return $q->select('id', 'name');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			'officer' => function ($q) {
				return $q->select('id', 'name');
			},
			'technician' => function ($q) {
				return $q->select('id', 'name');
			},
		])
			->join('distributor_users', 'distributor_users.distributor_id', '=', 'df_problems.distributor_id')
			->where('distributor_users.user_id', auth()->id())
			->select('df_problems.id', 'df_problems.token', 'df_problems.df_size', 'df_problems.depot_id', 'df_problems.outlet_name', 'df_problems.proprietor_name', 'df_problems.address', 'df_problems.mobile', 'df_problems.technician_id', 'df_problems.user_id', 'df_problems.status', 'df_problems.created_at', 'df_problems.region_id', 'df_problems.comments', 'df_problems.item_id')
			->selectRaw("IF(df_problems.df_code = 'personal','Personal',df_problems.df_code) as df_code")
			->selectRaw("CASE WHEN df_problems.support = 1 THEN 'Need' WHEN df_problems.support = 2 THEN NULL WHEN df_problems.support = 3 THEN 'Returned' ELSE 'Not Needed' END as supportdf")
			->latest();

		if ($param == 'new') {
			$query->where('df_problems.status', 'pending');
		} elseif ($param == 'damage-applied') {
			$query->whereIn('df_problems.status', ['applied_for_damage', 'damage_approved']);
		} elseif ($param == 'service_workshop') {
			$query->whereIn('pull', [1, 2]); //mipellim
		} elseif ($param == 'all') {
			$query->whereNotNull('df_problems.status');
		} else {
			$query->where('df_problems.status', $param);
		}
		//dd($query->get()->toArray());
		return datatables($query)->make(true);
	}

	public function getProblemDetails($id) {
		$dfproblems = DfProblem::with([
			'region' => function ($q) {
				return $q->select('id', 'name');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			'distributor' => function ($q) {
				return $q->select('id', 'outlet_name');
			},
			'technician' => function ($q) {
				return $q->select('id', 'name', 'mobile');
			},
			'supportdf' => function ($q) {
				return $q->select('id', 'serial_no');
			},
		])
			->find($id);
		//dd($dfproblems->toArray());

		$complains = ComplainType::join('problem_types', 'problem_types.id', '=', 'complain_types.problem_type_id')
			->where('complain_types.df_problem_id', $id)
			->pluck('problem_types.name')
			->implode(',');

		$dfproblems->df_problem = $complains;
		//return $dfproblems;
		return view('ajax.problem_details', compact('dfproblems'));
	}

	/*==========================Damage Application Start===========================*/
	public function getApplicationDetails($id) {
		$applications = DamageApplication::with([
			'item' => function ($q) {
				return $q->select('id', 'serial_no');
			},
			'shop' => function ($s) {
				return $s->select('id', 'outlet_name');
			},
			'settlement' => function ($s) {
				return $s->select('item_id', 'inject_date', 'receive_amount', 'status');
			},
			'depot' => function ($s) {
				return $s->select('id', 'name');
			},
			'damage_type',
		])
			->find($id);
		return view('ajax.get_application_details', compact('applications'));
	}
	private function application_approve($request) {
		$data = $request->all();
		$itemUpdate = false;
		$maxStage = Stage::where('module', 'damage_application')->max('sequence');
		if ($data['stage'] < $maxStage) {
			$updateArr['stage'] = $data['stage'] + 1;
			$updateArr['status'] = 'processing';
		} else {
			$itemUpdate = true;
			$updateArr['status'] = 'completed';
		}
		$applicationObj = DamageApplication::find($data['id']);
		if (!$applicationObj) {
			return response()->json([
				'error' => true, 'success' => false,
				'message' => 'Opps! Application does not match. Please try again.',
			]);
		}
		$application = $applicationObj->update($updateArr);
		if ($application) {
			if ($itemUpdate) {
				//when damage application final approved then settlement will be closed
				$settlementDataObj = (object) ['shop_id' => $applicationObj->shop_id, 'current_df' => $applicationObj->item_id, 'withdrawal_date' => $applicationObj->created_at];
				$this->settlementClose($settlementDataObj, 'closed', 'y');
				DfProblem::where('id', $applicationObj->df_problem_id)->update(['status' => 'damage_approved']);
				//item status update
				Item::where('id', $applicationObj->item_id)->update(['freeze_status' => 'damage']);
			}

			return response()->json([
				'error' => false,
				'success' => true,
				'message' => 'Action has successfully done',
			]);
		} else {
			return response()->json([
				'error' => true, 'success' => false,
				'message' => 'Opps! Something error. Please try again.',
			]);
		}

	}

	private function application_hold($request) {
		$data = $request->all();
		$application = DamageApplication::where('id', $data['id'])
			->update([
				'status' => 'on_hold',
			]);
		if ($application) {
			return response()->json([
				'error' => false,
				'success' => true,
				'message' => 'Action has successfully done',
			]);
		} else {
			return response()->json([
				'error' => true, 'success' => false,
				'message' => 'Opps! Something error. Please try again.',
			]);
		}
	}

	public function saveApplicationStageAction(Request $request) {
		$action = $request->get('action');
		$methodName = 'application_' . $action;
		return $this->$methodName($request);
		// if ($action == 'hold') {
		//     $validator = \Validator::make($data, [
		//         'comments' => 'required|max:150',
		//     ]);

		//     if ($validator->fails()) {
		//         return response()->json([
		//             'error' => true,
		//             'success' => true,
		//             'message' => 'Comments can not be blank.',
		//         ]);
		//     }
		// }
	}
	/*==========================Damage Application end===========================*/
}
?>