<?php

namespace App\Http\Controllers;

use App\Brand;
//use App\Location;
//use App\Zone;
use App\Depot;
use App\Item;
use App\Settlement;
use App\Shop;
use App\Size;
use App\StockDetail;
use App\Traits\PhpExcelFormater;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UploadsController extends Controller {
	use PhpExcelFormater;

	private function getLocationList($model, $level) {
		$nameSpace = 'App\\' . $model;
		return $nameSpace::where('level', $level)->pluck('name', 'id');
	}
	//distributor file upload
	private function distributorUpload($excelDataArray) {
		$depots = Depot::pluck('name', 'id');
		$divisions = $this->getLocationList('Location', 0);
		$districts = $this->getLocationList('Location', 1);
		$thanas = $this->getLocationList('Location', 2);
		$regions = $this->getLocationList('Zone', 0);
		$areas = $this->getLocationList('Zone', 1);
		$newKeyArr = collect(['division' => 'division_id', 'district' => 'district_id', 'thana' => 'thana_id', 'region' => 'region_id', 'area' => 'area_id']);

		$dataArray = [];
		foreach ($excelDataArray as $key => $value) {
			//$dataArray[$key] = $value;
			$existShopId = Shop::where('code', $value['distributor_code'])->value('id');
			if ($existShopId) {
				$data['outlet_name'] = html_entity_decode(str_replace(',', '.', $value['distributor_outlet_name']));
				$data['proprietor_name'] = html_entity_decode($value['proprietor_name']);
				$data['address'] = html_entity_decode($value['address']);
				$data['mobile'] = str_pad(trim($value['mobile']), 11, 0, STR_PAD_LEFT);
				$data['nid'] = trim($value['nid']);
				$data['trade_license'] = $value['trade_license'];
				$data['category'] = strtolower($value['shop_category']);
				$data['estimated_sales'] = (float) $value['estimated_sales'];
				$data['depot_id'] = $depots->search(trim($value['depot'])) ?: 0;
				$data['division_id'] = $divisions->search(trim($value['division'])) ?: 0;
				$data['district_id'] = $districts->search(trim($value['district'])) ?: 0;
				$data['thana_id'] = $thanas->search(trim($value['thana'])) ?: 0;
				$data['region_id'] = $regions->search(trim($value['region'])) ?: 0;
				$data['area_id'] = $areas->search(trim($value['area'])) ?: 0;
				Shop::where('id', $existShopId)->update($data);
			} else {
				$dataArray[$key]['pre_code'] = substr($value['distributor_code'], 4);
				$dataArray[$key]['code'] = $value['distributor_code'];
				$dataArray[$key]['outlet_name'] = html_entity_decode(str_replace(',', '.', $value['distributor_outlet_name']));
				$dataArray[$key]['proprietor_name'] = html_entity_decode($value['proprietor_name']);
				$dataArray[$key]['address'] = html_entity_decode($value['address']);
				$dataArray[$key]['mobile'] = str_pad(trim($value['mobile']), 11, 0, STR_PAD_LEFT);
				$dataArray[$key]['nid'] = trim($value['nid']);
				$dataArray[$key]['trade_license'] = $value['trade_license'];
				$dataArray[$key]['category'] = strtolower($value['shop_category']);
				$dataArray[$key]['estimated_sales'] = (float) $value['estimated_sales'];
				$dataArray[$key]['depot_id'] = $depots->search(trim($value['depot'])) ?: 0;
				$dataArray[$key]['division_id'] = $divisions->search(trim($value['division'])) ?: 0;
				$dataArray[$key]['district_id'] = $districts->search(trim($value['district'])) ?: 0;
				$dataArray[$key]['thana_id'] = $thanas->search(trim($value['thana'])) ?: 0;
				$dataArray[$key]['region_id'] = $regions->search(trim($value['region'])) ?: 0;
				$dataArray[$key]['area_id'] = $areas->search(trim($value['area'])) ?: 0;
				$dataArray[$key]['is_distributor'] = 1;
			}

		}
		$distributors = Shop::insert($dataArray);

		if ($distributors) {
			$message = "Successfully Uploaded";
			return redirect()->route('uploads.shops', 1)
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('uploads.shops', 1)
				->with('flash_danger', $message);
		}

	}

	//retailer upload
	private function retailerUpload($excelDataArray) {

		$distributorList = Shop::where('is_distributor', true)
			->select('id as distributor_id', 'code', 'division_id', 'district_id', 'thana_id', 'region_id', 'area_id', 'depot_id')
			->get();
		$arrDistributor = [];
		foreach ($distributorList->toArray() as $key => $value) {
			$code = $value['code'];
			unset($value['code']);
			$arrDistributor[$code] = $value;
		}

		$sizeList = Size::pluck('installment', 'name');
		$dataArray = [];

		//dd($excelDataArray);
		foreach ($excelDataArray as $key => $value) {
			$distributorCode = trim($value['distributor_code']);
			if (!empty($distributorCode) && array_key_exists($distributorCode, $arrDistributor)) {
				$subArr = $arrDistributor[$distributorCode];
				$installment = $sizeList->get($value['size']) ?: 1;
				$itemId = $value['id'];
				$outlet_name = html_entity_decode(trim(str_replace(',', '.', $value['outlet_name'])));
				$existShopId = Shop::where('outlet_name', $outlet_name)->where('mobile', trim($value['mobile']))->value('id');
				//process shop data start
				if (!$existShopId) {
					$shopData = [];
					$shopData['category'] = strtolower($value['category']);
					$shopData['outlet_name'] = $outlet_name;
					$shopData['proprietor_name'] = html_entity_decode($value['proprietor_name']);
					$shopData['nid'] = $value['nid'];
					$shopData['trade_license'] = $value['trade_license'];
					$shopData['mobile'] = $value['mobile'];
					$shopData['address'] = html_entity_decode($value['address']);
					$shopData['estimated_sales'] = (int) $value['estimated_sales'];
					$shopObj = Shop::create($shopData + $subArr);
					$shopId = $shopObj->id;
				} else {
					$shopId = $existShopId;
				}

				//process shop data end
				//process settlement data start
				if (!empty($value['serial_no'])) {
					$receiveAmount = intval(str_replace(',', '', $value['received_amount']));
					$settlementData = [];
					$settlementData['item_id'] = $itemId;
					$settlementData['shop_id'] = $shopId;
					$settlementData['receive_amount'] = $receiveAmount;
					$dateObj = Carbon::parse($value['inject_date']);
					$settlementData['inject_date'] = $dateObj->format('Y-m-d');
					if (!empty($receiveAmount)) {
						$settlementData['installment'] = $installment;
						$date = $dateObj->day;
						$month = $dateObj->month;
						$year = $dateObj->year;
						if ($date <= 15) {
							$settlementData['month_from'] = Carbon::createFromDate($year, $month, 1);
						} else {
							$settlementData['month_from'] = Carbon::createFromDate($year, $month + 1, 1);
						}
						$totalMonth = (int) round($receiveAmount / $installment);
						$monthTo = Carbon::parse($settlementData['month_from']);
						$settlementData['month_to'] = $monthTo->addMonths($totalMonth)->subDay(1);
					}

					//process settlement data end

					//update item
					$itemData['serial_no'] = 'DIIL/' . $value['brand'] . '/' . $value['size'] . '/' . $value['serial_no'];
					$itemData['shop_id'] = $shopId;
					if ($value['freeze_status'] == 'fresh') {
						$itemData['freeze_status'] = 'used';
					} else {
					    
					    //$itemData['freeze_status'] = $value['freeze_status;
					    $itemData['freeze_status'] = str_replace(' ', '_', strtolower($value['freeze_status']));
					}
					$itemData['item_status'] = 'continue';
					$itemUpdatedObj = Item::where('id', $itemId)->update($itemData);
					if ($itemUpdatedObj) {
						if (!Settlement::where('item_id', $itemId)
							->where('shop_id', $shopId)->exists()) {
							Settlement::create($settlementData);
						}

					}
				}

			} else {
				Item::where('id', $value['id'])->update(['freeze_status' => $value['freeze_status']]);
			}
		}
		$message = "Shop successfully uploaded.";
		return redirect()->route('uploads.shops')->with('flash_success', $message);
	}

	public function shops(Request $request, $is_distributor = null) {
		ini_set('max_execution_time', 60000);
		/*
			file path must be absolute and related to local drive
		*/
		//dump($this->dumptoarray($filePath));
		if ($request->isMethod('post')) {
			$data = $request->all();
			$file = $request->file('file');

			$request->validate([
				'file' => 'required|mimes:xlsx|max:1024',
			]);

			$filePath = $file->getRealPath();
			$excelDataArray = $this->dumptoarray($filePath);
			if (array_key_exists('btnRetailer', $data)) {
				return $this->retailerUpload($excelDataArray);
			} else {
				return $this->distributorUpload($excelDataArray);
			}

		} else {
			if ($is_distributor) {
				return view('uploads.distributor');
			} else {
				return view('uploads.shop');
			}

		}

	}
	//generate inventory
	public function generateInventory(Request $request) {
		if ($request->isMethod('post')) {
			$depots = Depot::pluck('name', 'id');

			$brands = Brand::pluck('short_code', 'id');
			$sizes = Size::pluck('name', 'id');
			$data = $request->all();
			$file = $request->file('file');
			$filePath = $file->getRealPath();
			$excelDataArray = $this->dumptoarray($filePath);
			$depotWiseDataArr = [];
			foreach ($excelDataArray as $value) {
				//$depot = $depots->search($value['depot']);
				//$brand = $brands->search($value['brand']);
				$size = $sizes->search($value['size']);
				$depotWiseDataArr[$size][] = $value;
			}

			//dd($depotWiseDataArr);

			foreach ($depotWiseDataArr as $key => $val) {
				$stockDetailArr['brand_id'] = $brands->search($val[0]['brand']);
				$stockDetailArr['size_id'] = $key;
				$stockDetailArr['stock_id'] = 101;
				$totalQty = 0;
				$stockDetailArr = [];
				foreach ($val as $v) {
					$totalQty += $v['quantity'];
				}
				$stockDetailArr['qty'] = $totalQty;
				$stockDetailArr['receive_qty'] = $totalQty;

				$stockDetailId = StockDetail::create($stockDetailArr);
			}

			dd($stockDetailArr);
		} else {
			return view('uploads.generate_inventory');
		}

	}
}
