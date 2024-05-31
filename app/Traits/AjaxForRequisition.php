<?php
namespace App\Traits;
use App\Bkash;
use App\Brand;
use App\DfReturn;
use App\Document;
use App\Item;
use App\PhysicalVisit;
use App\Requisition;
use App\Shop;
use App\Stage;
use App\Traits\BkashTrait;
use App\Traits\SmsTrait;
use App\Traits\StockCheckTrait;
use Illuminate\Http\Request;

trait AjaxForRequisition {
	use SmsTrait, BkashTrait, StockCheckTrait;

	public function getShopsWithPaginate($param = '0') {

		$query = Shop::select(
			'shops.id',
			'shops.outlet_name as outlet_name',
			'shops.proprietor_name',
			'shops.is_distributor',
			'shops.distributor_id',
			'shops.mobile',
			'district.name as districtName',
			'thana.name as thanaName',
			'region.name as regionName',
			'shops.code',
			'shops.status',
			'distributor.outlet_name as distributor',
			'depots.name as depotName'
		)
			->withCount('requisitions')
			->where('shops.is_distributor', false)
			->join('depots', 'depots.id', '=', 'shops.depot_id')
			->leftJoin('zones as region', 'region.id', '=', 'shops.region_id')
			->leftJoin('locations as district', 'district.id', '=', 'shops.district_id')
			->leftJoin('locations as thana', 'thana.id', '=', 'shops.thana_id')
			->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
			->join('shops as distributor', 'distributor.id', '=', 'shops.distributor_id')
			->where('distributor_users.user_id', auth()->user()->id);

		if (!$param) {
			$query->join('settlements', 'shops.id', '=', 'settlements.shop_id')
				->whereIn('settlements.status', ['continue', 'reserve'])
				->join('items', 'items.id', '=', 'settlements.item_id')
				->selectRaw('GROUP_CONCAT(items.serial_no) as dfCodes');

		} else {
			$query->leftJoin('settlements', 'settlements.shop_id', '=', 'shops.id')
				->selectRaw('SUM(settlements.status in ("continue","reserve")) as countVal')
				->having('countVal', '<', 1)
				->orHavingRaw('countVal is null');

		}
		$query->groupBy('shops.id')->orderBy('shops.updated_at', 'desc');

		//return $query->get()->toArray();

		return datatables($query)->make(true);
	}

	//shop (retailer and distributor) details view in modal
	public function getShopDetails($shopId) {
		$shop = Shop::with([
			'division' => function ($q) {
				return $q->select('id', 'name');
			},
			'district' => function ($q) {
				return $q->select('id', 'name');
			},
			'thana' => function ($q) {
				return $q->select('id', 'name');
			},
			'region' => function ($q) {
				return $q->select('id', 'name');
			},
			'area' => function ($q) {
				return $q->select('id', 'name');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			'distributor' => function ($q) {
				return $q->select('id', 'outlet_name');
			},
			'items' => function ($q) {
				return $q->select('id', 'shop_id', 'serial_no', 'freeze_status')
					->whereIn('item_status', ['continue', 'reserve']);
			},
		])
			->find($shopId);
		return view('ajax.shop_details', compact('shop'));
	}

	//shop (retailer and distributor) details view in modal
	public function getShopCompareDetails($returnId) {

		$dfReturn = DfReturn::find($returnId);

		$fromShopId = $dfReturn->shop_id;
		$toShopId = $dfReturn->to_shop;

		$fromShop = Shop::with([
			'division' => function ($q) {
				return $q->select('id', 'name');
			},
			'district' => function ($q) {
				return $q->select('id', 'name');
			},
			'thana' => function ($q) {
				return $q->select('id', 'name');
			},
			'region' => function ($q) {
				return $q->select('id', 'name');
			},
			'area' => function ($q) {
				return $q->select('id', 'name');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			'distributor' => function ($q) {
				return $q->select('id', 'outlet_name');
			},
		])
			->find($fromShopId);
		$toShop = null;
		if ($toShopId > 0) {
			$toShop = Shop::with([
				'division' => function ($q) {
					return $q->select('id', 'name');
				},
				'district' => function ($q) {
					return $q->select('id', 'name');
				},
				'thana' => function ($q) {
					return $q->select('id', 'name');
				},
				'region' => function ($q) {
					return $q->select('id', 'name');
				},
				'area' => function ($q) {
					return $q->select('id', 'name');
				},
				'depot' => function ($q) {
					return $q->select('id', 'name');
				},
				'distributor' => function ($q) {
					return $q->select('id', 'outlet_name');
				},
			])
				->find($toShopId);
		}
		if ($toShopId > 0) {

			return view('ajax.shop_compare_details', compact('fromShop', 'toShop'));
		} else {
			$shop = $fromShop;
			return view('ajax.shop_details', compact('shop'));
		}
	}

	//shop (retailer and distributor) details view in modal
	public function getDistributorDetails($shopId) {
		$shop = Shop::with([
			'detail',
			'division' => function ($q) {
				return $q->select('id', 'name');
			},
			'district' => function ($q) {
				return $q->select('id', 'name');
			},
			'thana' => function ($q) {
				return $q->select('id', 'name');
			},
			'region' => function ($q) {
				return $q->select('id', 'name');
			},
			'area' => function ($q) {
				return $q->select('id', 'name');
			},
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
			'distributor' => function ($q) {
				return $q->select('id', 'outlet_name');
			},
		])
			->find($shopId);

		return view('ajax.distributor_details', compact('shop'));
	}

	/*
		    1.get shop list by changing user_id in requistion_add and requisition_edit
		    2.get distributor list by changing depot_id in shop_add,shop_edit and personal DF Problem Entry(if auth user has multiple depot)
	*/
	public function getShops(Request $request) {
		$data = $request->all();
		$isDistributor = true;
		$shops = collect([]);
		if (!empty($data['user_id'])) {
			//in requisition add and edit
			$isDistributor = false;
			$shops = Shop::where('shops.is_distributor', false)
				->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
				->join('shops as distributors', 'distributors.id', '=', 'shops.distributor_id')
				->where('shops.status', 'active')
				->where('distributor_users.user_id', $data['user_id'])
				->select('shops.id')
				->selectRaw("CONCAT(shops.outlet_name,'::',shops.mobile,' (',distributors.outlet_name, ')') as outlet_name")
				->orderBy('distributors.outlet_name')
				->pluck('outlet_name', 'shops.id');

		} elseif (!empty($data['depot_id'])) {
			//in shop add and edit
			$shops = Shop::where('shops.depot_id', $data['depot_id'])
				->where('shops.is_distributor', $isDistributor)
				->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.id')
				->where('shops.status', 'active')
				->where('distributor_users.user_id', auth()->user()->id)
				->pluck('shops.outlet_name', 'shops.id'); //distributor list
		}
		return view('ajax.get_shops', compact('shops', 'isDistributor'));
	}

	private function sendRequisitionSms($action, $dataArr) {
		//requisition cancel sms for executive
		$requisitionSmsData = Requisition::requisitionApprovalSmsData($dataArr['id']);
		$requisitionSmsData->setAttribute('comments', $dataArr['comments']);
		$requisitionSmsData->setAttribute('from', auth()->user()->name . '(' . auth()->user()->designation->short_name . ')');
		return $this->sendSms($requisitionSmsData, $action);
	}

	//for on hold requistion update fields are stage_staus = on_hold, status = on_hold
	private function requisition_hold($request) {
		$data = $request->all();
		$requisition = Requisition::where('id', $data['id'])
			->update([
				'action_by' => auth()->user()->id,
				'stage_status' => 'on_hold',
				'status' => 'on_hold',
			]);
		if ($requisition) {
			//requisition hold sms for executive
			$this->sendRequisitionSms('requisition_hold', $data);
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

	private function requisition_approve($request) {
		$data = $request->all();
		$reqisitionStage = $data['stage'];
		$maxStageSeq = Stage::where('module', 'requisition')
			->max('sequence');

		$requisitionObj = Requisition::select('id', 'payment_modes', 'action_by', 'stage_status', 'status', 'payment_verified')
			->find($data['id']);

		/*if requision is full paid then application will final approve one stage before*/
		if ($requisitionObj->payment_modes == 'full_paid') {
			$maxStageSeq = $maxStageSeq - 1;
		}

		if ($reqisitionStage < $maxStageSeq) {
			$requisition = Requisition::where('id', $data['id'])
				->update([
					'action_by' => auth()->user()->id,
					'stage_status' => 'pending',
					'status' => 'processing',
					'stage' => $data['stage'] + 1,
				]);

		} else {
			$updateableArr = [
				'action_by' => auth()->user()->id,
				'stage_status' => 'approved',
				'status' => 'approved',
				'approved_at' => \Carbon\Carbon::now(),
			];
			if ($requisitionObj->payment_modes == 'without_rent') {
				$updateableArr['payment_verified'] = 'yes';
			}

			$requisition = $requisitionObj->update($updateableArr);
			//when the requisition final approved then send sms
			if ($requisition) {
				$requisitionSmsData = Requisition::requisitionApprovalSmsData($data['id']);
				$this->sendSms($requisitionSmsData, 'requisition_approve');
			}

		}

		if ($requisition) {
			if ($reqisitionStage <= 2) {
				if (!empty($data['status'])) {
					$newData['status'] = $data['status'];
				}
				$newData['requisition_id'] = $data['id'];
				$newData['stage'] = $reqisitionStage;
				$newData['user_id'] = auth()->user()->id;
				PhysicalVisit::create($newData);
			}

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

	private function requisition_cancel($request) {
		$data = $request->all();
		$requisitionObj = Requisition::select('id', 'type', 'shop_id', 'current_df', 'action_by', 'stage_status', 'status')->find($data['id']);
		if ($requisitionObj->type == 'replace') {
			//inserted current df will be unlock
			$this->settlementLockUnlock($requisitionObj, true);
		}
		$requisition = $requisitionObj->update([
			'action_by' => auth()->user()->id,
			'stage_status' => 'cancelled',
			'status' => 'cancelled',
		]);
		if ($requisition) {
			//requisition cancel sms for executive
			$this->sendRequisitionSms('requisition_cancel', $data);
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

	private function requisition_validate($request) {
		$data = $request->all();
		$requisition = Requisition::where('id', $data['id'])
			->update([
				'action_by' => auth()->user()->id,
				'validate_by' => auth()->user()->id,
				'last_three_months_avg_sales_real' => $data['last_three_months_avg_sales_real'],
				'average_sales_real' => $data['average_sales_real'],
			]);
		if ($requisition) {
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

	public function getRequisitionDetails($id) {
		$requisition = Requisition::with([
			'creator' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'size' => function ($qu) {
				return $qu->select('id', 'name', 'installment');
			},
			'shop' => function ($qu) {
				return $qu->select('id', 'outlet_name', 'proprietor_name', 'mobile', 'category', 'address', 'estimated_sales');
			},
			'currentdf' => function ($qu) {
				return $qu->select('id', 'serial_no');
			},
			'item' => function ($qu) {
				return $qu->select('id', 'serial_no');
			},
			'stager' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'payment_verifier' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'document_verifier' => function ($qu) {
				return $qu->select('id', 'name');
			},
			'physical_visits' => function ($qu) {
				return $qu->with(['user' => function ($u) {
					return $u->select('id', 'name');
				}])
					->select('requisition_id', 'user_id', 'status')
					->orderBy('stage', 'asc');

			},
			'comments' => function ($qu) {
				return $qu->with(['user' => function ($u) {
					return $u->select('id', 'name');
				}])
					->select('id', 'requisition_id', 'action_name', 'user_id', 'comments', 'updated_at')
					->orderBy('updated_at', 'desc')
					->take(5);
			},
			'validator' => function ($qu) {
				return $qu->select('id', 'name');
			},

		])
			->withCount([
				'bkashes as total' => function ($q) {
					return $q->select(\DB::raw('SUM(receive_amount)'));
				},
			])
			->find($id);
		//return $requisition;
		return view('ajax.requisition_details', compact('requisition'));
	}

	public function checkRequisitionStatus(Request $request) {
		$data = $request->all();
		$id = $data['id'];
		if (Requisition::where('id', $id)->where('status', 'completed')->exists()) {
			return 'yes';
		} else {
			return 'no';
		}
	}

	public function getTransactionId(Request $request) {
		$data = $request->all();
		$id = $data['id'];
		$requisition = Requisition::with(['bkashes' => function ($q) {
			return $q->select('requisition_id', 'transaction_id', 'receive_amount');
		}])
			->select('id', 'receive_amount')
			->find($id);
		return view('ajax.get_transaction_id', compact('id', 'requisition'));
	}

	//add or edit item serial
	public function putTransactionId(Request $request) {
		//saveStageAction
		$methodName = 'put';
		$data = $request->all();
		//$data['id'] = 3;
		$bkash = false;
		$message = '';
		if (!empty($data['transaction_id'])) {
			if (!Bkash::where('transaction_id', $data['transaction_id'])
				->exists()) {
				$bkash = true;
			} else {
				$message = 'This Transaction ID already used.';
			}

		} else {
			$message = 'Please input your Transaction ID';
		}
		if ($bkash) {
			$bkashTransaction['trxid'] = $data['transaction_id'];
			$bkashApiResponse = $this->callBkashApi($bkashTransaction);
			//return $bkashApiResponse;
			if ($bkashApiResponse['transaction']['trxStatus'] == '0000') {
				// dd($data);
				$requsitionObj = Requisition::select('id', 'payment_confirm', 'receive_amount')->find($data['id']);

				$bkashData = [
					'requisition_id' => $data['id'],
					'transaction_id' => $data['transaction_id'],
					'reference' => $bkashApiResponse['transaction']['reference'],
					'receive_amount' => $bkashApiResponse['transaction']['amount'],
					'sender' => $bkashApiResponse['transaction']['sender'],
					'trx_time' => \Carbon\Carbon::parse($bkashApiResponse['transaction']['trxTimestamp'])->format('Y-m-d h:i:s'),

				];
				$bkashSave = Bkash::create($bkashData);
				if ($bkashSave) {
					$totalBkashPaidAmount = Bkash::where('requisition_id', $data['id'])->sum('receive_amount');
					//sms send to shop owner after bkash payment successfull
					$requisitionSmsData = Requisition::requisitionApprovalSmsData($data['id']);
					$requisitionSmsData->setAttribute('receive_amount', $bkashData['receive_amount']);
					$this->sendSms($requisitionSmsData, 'putTransactionId');
					if ($totalBkashPaidAmount >= $requsitionObj->receive_amount) {
						$requsitionObj->update(['payment_confirm' => true]);
						return response()->json([
							'error' => false,
							'success' => true,
							'message' => 'Your transaction successfully done',
						]);
					} else {
						$due = $requsitionObj->receive_amount - $totalBkashPaidAmount;
						$bkashData['due'] = $due;
						$bkashData['bkashAmount'] = $totalBkashPaidAmount;
						return response()->json([
							'error' => true,
							'success' => true,
							'data' => $bkashData,
							'message' => "Your due amount is TK. $due,please complete your payment",
						]);
					}

				} else {

					return response()->json([
						'error' => true,
						'success' => false,
						'message' => 'Opps! Something error. Please try again.',
					]);
				}
			} else {
				$message = array_get($this->bkashReturnMessageArr, $bkashApiResponse['transaction']['trxStatus']);
				if (empty($message)) {
					$message = 'Something is wrong.please try again.';
				}

				return response()->json([
					'error' => true,
					'success' => true,
					'message' => $message,
				]);
			}

		} else {
			return response()->json([
				'error' => true,
				'success' => true,
				'message' => $message,
			]);
		}

	}

	//depot distributor
	public function getDepotDistributor(Request $request) {
		$data = $request->all();
		$depotId = $data['depot_id'];
		$id = $data['distributor_id'];
		$notForm = false;
		if (!empty($data['notForm'])) {
			$notForm = $data['notForm'];
		}
		$distributors = Shop::where('is_distributor', true)
			->where('depot_id', $depotId)
			->where('id', '<>', $id)
			->pluck('outlet_name', 'id');
		return view('ajax.depot_distributor', compact('distributors', 'depotId', 'id', 'notForm'));
	}

	//depot distributor
	public function getDepotItemBrand(Request $request) {
		$data = $request->all();
		$size = $data['size'];
		$depotItemBrandObj = Item::select('id', 'brand_id')
			->where('depot_id', $data['depot_id'])
			->where('size_id', $data['size_id'])
			->whereNull('item_status')
			->whereNull('serial_no')
			->DISTINCT('brand_id');
		$depotItemBrandObj2 = clone $depotItemBrandObj;
		$depotItemBrands = $depotItemBrandObj->pluck('brand_id');
		$brands = Brand::whereIn('id', $depotItemBrands)->pluck('short_code', 'id');
		$item = null;
		if ($brands->count()) {
			if (!empty($data['brand_id'])) {
				$brandId = $data['brand_id'];
			} else {
				$brandId = $brands->keys()->first();
			}
			$item = $depotItemBrandObj2->where('brand_id', $brandId)->first();
		}
		return view('ajax.input_item_serial', compact('brands', 'size', 'item', 'brandId'));
	}

	public function getCurrentDfs(Request $request) {
		$shop_id = $request->get('shop_id');
		$itemIds = \App\Settlement::where('shop_id', $shop_id)
			->where('status', 'continue')
			->pluck('item_id');
		$currentdfs = Item::whereIn('id', $itemIds)->pluck('serial_no', 'id');
		return view('ajax.show_current_df_lists', compact('currentdfs'));
	}

	public function getReturnDFSizes(Request $request) {
		$shop_id = $request->get('shop_id');
		$dfreturns = collect([]);
		if ($shop_id) {
			$dfreturns = \App\DfReturn::select('items.size_id')
				->join('items', 'items.id', '=', 'df_returns.current_df')
				->where('to_shop', $shop_id)
				->where('df_returns.status', '<>', 'cancelled')
				->where('df_returns.is_requisition_created', false)
				->get();
		}

		if ($dfreturns->isNotEmpty()) {
			$sizeIds = $dfreturns->pluck('size_id', 'size_id');
			$sizes = \App\Size::whereIn('id', $sizeIds->values())->orderBy('name', 'asc')->pluck('name', 'id');
		} else {
			$sizes = \App\Size::where('availability', 'yes')->orderBy('name', 'asc')->pluck('name', 'id');
		}
		return $sizes;
	}

	public function getReturnDF(Request $request) {
		$shop_id = $request->get('shop_id');
		$size_id = $request->get('size_id');
		$dfreturns = collect([]);
		if ($shop_id && $size_id) {
			$dfreturns = \App\DfReturn::select('df_returns.id', 'items.serial_no', 'shops.outlet_name')
				->join('items', 'items.id', '=', 'df_returns.current_df')
				->join('shops', 'shops.id', '=', 'df_returns.shop_id')
				->where('to_shop', $shop_id)
				->where('items.size_id', $size_id)
				->where('df_returns.status', '<>', 'cancelled')
				->where('df_returns.is_requisition_created', false)
				->get();
		}

		return ['datas' => $dfreturns];
	}

	//check available stock
	public function checkStock(Request $request) {
		$shop_id = $request->get('shop_id');
		$size_id = $request->get('size_id');
		$depot_id = $request->get('depot_id');
		if ($depot_id) {
			return $this->checkAvailableStock($size_id, null, $depot_id);
		} else {
			return $this->checkAvailableStock($size_id, $shop_id);
		}

	}

	//get all documents for shop with requisition
	public function getAllDocuments(Request $request) {
		$shop = Shop::with(['documents' => function ($q) {
			return $q->select('shop_id', 'field_name', 'file_name')
				->whereNull('data_id')
				->whereNull('module');
		}])
			->where('id', $request->shop_id)
			->select('id', 'outlet_name', 'proprietor_name', 'mobile');

		$shopData = $shop->first();

		$documentsObj = Document::join('settlements', 'settlements.requisition_id', '=', 'documents.data_id')
			->join('items', 'items.id', '=', 'settlements.item_id')
			->whereNotNull('documents.data_id')
			->whereNotNull('documents.module')
			->where('documents.shop_id', $request->shop_id)
			->whereIn('settlements.status', ['reserve', 'continue'])
			->select('documents.data_id', 'documents.shop_id', 'documents.field_name', 'documents.file_name', 'settlements.item_id', 'items.serial_no');

		if ($request->requisition_id) {
			$documentsObj->where('documents.data_id', $request->requisition_id);
		}
		$documentsDataObj = $documentsObj->get();
		$documentsDataArr = [];
		foreach ($documentsDataObj as $value) {
			$documentsDataArr[$value->data_id][] = $value;
		}
		return view('ajax.view_all_documents', compact('shopData', 'documentsDataArr'));
	}

}
?>