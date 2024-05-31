<?php

namespace App\Http\Controllers\Report;

use App\Exports\BrandWiseDfExport;
use App\Exports\DFRecivedAdndDeliveryExport;
use App\Exports\SizeWiseDfExport;
use App\Exports\SizeWiseDistributorDfExport;
use App\Http\Controllers\Controller;
use App\Repositories\Models\AllocationRepository;
use App\Repositories\Models\BrandRepository;
use App\Repositories\Models\DepotRepository;
use App\Repositories\Models\ItemRepository;
use App\Repositories\Models\SizeRepository;
use App\Repositories\Models\StockRepository;
use App\Repositories\Models\ZoneRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InventoryReportsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($param = 0, Request $request) {
		$is_download = 0;
		if ($param == 0) {
			$start_date = '2009';
			$end_date = Carbon::now()->format('Y');
			$title = 'Overall DF received & Delivery';
		} else {
			$start_date = '01-01-2009';
			$end_date = Carbon::now()->format('d-m-Y');
		}

		if ($request->isMethod('post')) {
			$button = $request->get('submit');
			if ($button == 'download') {
				$is_download = 1;
			}
			if ($request->has('start_date')) {
				$start_date = $request->input('start_date');
			}
			if ($request->has('end_date')) {
				$end_date = $request->input('end_date');
			}
		}

		$repotsData = collect([]);
		$stocks = collect([]);

		if ($param == 0) {
			$stockRepository = new StockRepository;
			$stocks = $stockRepository->getStockHistory('Year', $start_date, $end_date);

			$allocationRepository = new AllocationRepository;
			$repotsData = $allocationRepository->getAllocationHistory('Year', $start_date, $end_date);
		} elseif ($param == 1) {

			$stockRepository = new StockRepository;
			$stocks = $stockRepository->getStockHistory('Date', $start_date, $end_date);
		} else {

			$allocationRepository = new AllocationRepository;
			$repotsData = $allocationRepository->getAllocationHistory('Date', $start_date, $end_date);
		}

		$uniqueSizeArr = [];
		foreach ($stocks as $key => $value) {
			if ($value->stock_details->isNotEmpty()) {
				foreach ($value->stock_details as $k => $v) {
					$uniqueSizeArr[$v->size_id] = $v->brand_id;
				}
			}
		}

		$size = new SizeRepository;
		$sizes = $size->getAll()->pluck('name', 'id');

		$depots = \App\Depot::pluck('name', 'id');

		$brandRepository = new BrandRepository;
		$brands = $brandRepository->all()->pluck('short_code', 'id');

		$reports = [];
		$checkArr = [];

		if ($repotsData) {
			foreach ($repotsData as $ele) {
				$x = $ele->created . '-' . $ele->size_id . '-' . $ele->depot_id;
				if (in_array($x, $checkArr)) {
					$reports[$ele->created][$ele->size_id][$ele->depot_id] += $ele->total;
				} else {
					$checkArr[] = $x;
					$reports[$ele->created][$ele->size_id][$ele->depot_id] = $ele->total;
				}

			}
		}

		if ($is_download == 1) {
			if ($param == 0) {
				$filename = 'Overall DF Delivery & Received Report from ' . $start_date . ' to ' . $end_date . '.xlsx';
			} elseif ($param == 1) {
				$filename = 'DF Delivery Report from ' . $start_date . ' to ' . $end_date . '.xlsx';
			} else {
				$filename = 'DF Received Report from ' . $start_date . ' to ' . $end_date . '.xlsx';
			}
			return (new DFRecivedAdndDeliveryExport($param, compact('stocks', 'brands', 'sizes', 'depots', 'uniqueSizeArr', 'reports', 'start_date', 'start_date', 'end_date')))->download($filename);
		} else {
			return view('reports.inventory.receive_delivery.index', compact('param', 'stocks', 'brands', 'sizes', 'depots', 'uniqueSizeArr', 'reports', 'start_date', 'end_date'));
		}

	}

	public function getDepotDFStatus() {
		$zoneRepository = new ZoneRepository;
		$regions = $zoneRepository->getRegions();
		return view('reports.inventory.depot-df-status', compact('regions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function getAreaWise(Request $request) {

		$validatedData = $request->validate([
			'region_id' => 'required',
			'start_date' => 'required|date',
			'finish_date' => 'required|date|after_or_equal:start_date',
		]);

		if ($validator->fails()) {
			return redirect()->route('inventoryreports.index')
				->withErrors($validator)
				->withInput();
		}

		$region_id = $request->input('region_id');
		$start_date = $request->input('start_date');
		$finish_date = $request->input('finish_date');

	}

	/**
	 * Show the listing of Size wise Deep Freeze Status.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getSizeWiseDFStatus($param = 0, Request $request) {

		$reporting_year = Carbon::now()->format('Y');

		$selectedSizes = [];
		$checkedIds = [];
		$is_download = 0;

		if ($request->isMethod('post')) {

			$reporting_year = $request->input('reporting_year');
			$checkedIds = $request->input('sizes');
			$is_download = $request->input('is_download');
		}
		$size = new SizeRepository;
		$sizeCollection = $size->getAll();
		$sizes = $sizeCollection->pluck('name', 'id');

		if ($checkedIds) {
			$selectedSizes = $sizeCollection->whereIn('id', $checkedIds);
			$selectedSizes = $selectedSizes->pluck('name', 'id');
		} else {
			$selectedSizes = $sizes;
		}

		$item = new ItemRepository;
		$items = $item->getWithDepotsSizesByYear($reporting_year, $checkedIds);

		$depot = new DepotRepository;
		$depots = $depot->getAll();

		$filterData = [];
		foreach ($items as $key => $value) {
			$filterData[$value->depot_id][$value->size_id] = $value->totalSize;
		}

		$itemGroups = $items->mapToGroups(function ($item) {
			return [$item['size_id'] => $item['totalSize']];
		});

		if ($is_download == 1) {
			return (new SizeWiseDfExport(compact('selectedSizes', 'sizes', 'filterData', 'depots', 'itemGroups')))->download('size-wise-df-status.xlsx');
		}

		return view('reports.inventory.size_wise_df_status', compact('selectedSizes', 'sizes', 'filterData', 'depots', 'itemGroups'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getSizeWiseDistributorDFStatus($param = '0', Request $request) {

		$reporting_year = Carbon::now()->format('Y');
		$sizeIds = [];
		$is_download = 0;
		$checkedIds = [];

		if ($request->isMethod('post')) {

			$reporting_year = $request->input('reporting_year');
			$sizeIds = $request->input('sizes');
			$is_download = $request->input('is_download');
		}

		$size = new SizeRepository;
		$sizeCollection = $size->getAll();
		$sizes = $sizeCollection->pluck('name', 'id');

		if ($sizeIds) {
			$selectedSizes = $sizeCollection->whereIn('id', $sizeIds);
			$selectedSizes = $selectedSizes->pluck('name', 'id');
		} else {
			$selectedSizes = $sizes;
		}

		$depot = new DepotRepository;
		$depots = $depot->getAll();

		$itemRepository = new ItemRepository;

		$items = $itemRepository->getDepotsDistributorSizes($reporting_year, $checkedIds);

		if ($is_download == 1) {
			return (new SizeWiseDistributorDfExport(compact('selectedSizes', 'sizes', 'sizeIds', 'depots', 'items', 'reporting_year')))->download('size-wise-df-status.xlsx');
		}
		//$regions = Zone::whereNull('parent_id')->pluck('name', 'id');
		//$divisions = Location::whereNull('parent_id')->pluck('name', 'id');

		return view('reports.inventory.size_wise_distributor_df_status', compact('param', 'selectedSizes', 'sizes', 'sizeIds', 'depots', 'items', 'reporting_year'));
	}

	private function regionWiseDFBrand($start_date, $end_date, $regionIds, $brandIds, $sizeIds, $is_download, $is_post) {

		$param = 0;

		$authUserId = auth()->user()->id;

		$zoneRepository = new ZoneRepository;
		$regions = $zoneRepository->getRegions($authUserId);

		$brandRepository = new BrandRepository;
		$brands = $brandRepository->all()->pluck('short_code', 'id');

		$sizeRepository = new SizeRepository;
		$sizes = $sizeRepository->getAll()->pluck('name', 'id');

		$brandSizes = $brandRepository->getBrandSizes($brandIds, $sizeIds);
		//dd($brandSizes->toArray());

		$reports = [];

		//$brandSizes = collect([]);

		//$regionDepots = collect([]);

		if ($is_post) {

			if ($regionIds) {
				$regionIDs = $regionIds;
			} else {
				$regionIDs = $regions->keys();
			}

			$regionDepots = $zoneRepository->depots($regionIDs);

			$reportsData = $brandRepository->getRegionWiseBrandDFStatus($start_date, $end_date, $regionIDs, $brandIds, $sizeIds);
			//dd($reportsData->toArray());

			$totals = [];
			foreach ($reportsData as $data) {
				$reports[$data->zone_id][$data->depot_id][$data->brand_id][$data->size_id] = $data->total;

				$totals['depot'][$data->depot_id] = isset($totals['depot'][$data->depot_id]) ? $totals['depot'][$data->depot_id] + $data->total : $data->total;

				$totals['brand_size'][$data->brand_id][$data->size_id] = isset($totals['brand_size'][$data->brand_id][$data->size_id]) ? $totals['brand_size'][$data->brand_id][$data->size_id] + $data->total : $data->total;
			}
		}

		if ($is_download == 1) {
			return (new BrandWiseDfExport(compact('param', 'regions', 'brands', 'sizes', 'brandSizes', 'reports', 'regionDepots', 'totals', 'sizeIds', 'brandIds', 'regionIds', 'start_date', 'end_date')))->download('region-wise_report.xlsx');
		}

		return view('reports.inventory.brand_wise.index', compact('param', 'regions', 'brands', 'sizes', 'brandSizes', 'reports', 'regionDepots', 'totals', 'sizeIds', 'brandIds', 'regionIds', 'start_date', 'end_date', 'is_post'));

	}

	private function locationWiseDFBrand($start_date, $end_date, $brandIds, $sizeIds, $divisionIds, $districtIds, $thanaIds, $is_download, $is_post) {

		$param = 1;

		$authUserId = auth()->user()->id;

		$divisionObj = \App\Location::whereNull('locations.parent_id')
			->join('depots', 'depots.division_id', '=', 'locations.id')
			->join('depot_users', 'depot_users.depot_id', '=', 'depots.id')
			->select('locations.id', 'locations.name')
			->groupBy(['locations.id', 'locations.name'])
			->where('depot_users.user_id', $authUserId);

		$divisions = $divisionObj->pluck('name', 'id');

		$brandRepository = new BrandRepository;
		$brands = $brandRepository->all()->pluck('short_code', 'id');

		$sizeRepository = new SizeRepository;
		$sizes = $sizeRepository->getAll()->pluck('name', 'id');

		$brandSizes = collect([]);
		$locations = collect([]);

		if ($is_post) {

			$brandSizes = $brandRepository->getBrandSizes($brandIds, $sizeIds);

			//dd($brandSizes->toArray());

			if ($divisionIds) {
				$locations = \App\Location::whereIn('id', $divisionIds)->whereNull('parent_id');
			} else {
				$divisionIDs = $divisionObj->pluck('id')->toArray();
				$locations = \App\Location::whereIn('id', $divisionIDs)->whereNull('parent_id');
			}

			$locations->with(['children' => function ($q) use ($districtIds, $thanaIds) {
				if ($districtIds) {
					return $q->with(['children' => function ($q) use ($thanaIds) {
						if ($thanaIds) {
							return $q->whereIn('id', $thanaIds);
						}
						return $q;
					}])->whereIn('id', $districtIds);
				}
				return $q->with('children');

			}]);

			$locations = $locations->get();

			$rowspans = [];
			foreach ($locations as $location) {
				$row = 0;
				foreach ($location->children as $loc) {
					$row += $loc->children->count();
				}
				$rowspans[$location->id] = $row;
			}

			$reports = [];

			$reportsData = $brandRepository->getLocationWiseBrandDFStatus($start_date, $end_date, $brandIds, $sizeIds, $divisionIds, $districtIds, $thanaIds);

			//dd($divisionIds);
			$totals = [];
			foreach ($reportsData as $data) {
				$reports[$data->division_id][$data->district_id][$data->thana_id][$data->brand_id][$data->size_id] = $data->total;

				$totals['rows'][$data->thana_id] = isset($totals['rows'][$data->thana_id]) ? $totals['rows'][$data->thana_id] + $data->total : $data->total;

				$totals['columns'][$data->brand_id][$data->size_id] = isset($totals['columns'][$data->brand_id][$data->size_id]) ? $totals['columns'][$data->brand_id][$data->size_id] + $data->total : $data->total;
			}

		}

		if ($is_download == 1) {
			return (new BrandWiseDfExport(compact('param', 'start_date', 'end_date', 'brands', 'sizes', 'brandSizes', 'reports', 'totals', 'sizeIds', 'brandIds', 'divisions', 'locations', 'rowspans', 'divisionIds', 'districtIds', 'thanaIds')))->download('location_wise_report.xlsx');
		}

		return view('reports.inventory.brand_wise.index', compact('param', 'start_date', 'end_date', 'brands', 'sizes', 'brandSizes', 'reports', 'totals', 'sizeIds', 'brandIds', 'divisions', 'locations', 'rowspans', 'divisionIds', 'districtIds', 'thanaIds', 'is_post'));

	}

	private function depotWiseDFBrand($start_date, $end_date, $brandIds, $sizeIds, $depotIds, $distributorIds, $is_download, $is_post) {

		$param = 2;

		$authUserId = auth()->user()->id;

		$brandRepository = new BrandRepository;
		$brands = $brandRepository->all()->pluck('short_code', 'id');

		$sizeRepository = new SizeRepository;
		$sizes = $sizeRepository->getAll()->pluck('name', 'id');

		$brandSizes = $brandRepository->getBrandSizes($brandIds, $sizeIds);
		//dd($brandSizes->toArray());

		$depotRepository = new DepotRepository;
		$depots = $depotRepository->getAllByUserID($authUserId);

		if ($is_post) {

			$depotDistributors = $depotRepository->distributors($depotIds, $distributorIds);

			$reports = [];

			$reportsData = $brandRepository->getDepotWiseBrandDFStatus($start_date, $end_date, $brandIds, $sizeIds, $depotIds, $distributorIds);
			$totals = [];
			foreach ($reportsData as $data) {
				$reports[$data->depot_id][$data->distributor_id][$data->brand_id][$data->size_id] = $data->total;

				$totals['rows'][$data->distributor_id] = isset($totals['rows'][$data->distributor_id]) ? $totals['rows'][$data->distributor_id] + $data->total : $data->total;

				$totals['columns'][$data->brand_id][$data->size_id] = isset($totals['columns'][$data->brand_id][$data->size_id]) ? $totals['columns'][$data->brand_id][$data->size_id] + $data->total : $data->total;
			}
		}
		//dd($totals);
		if ($is_download == 1) {
			return (new BrandWiseDfExport(compact('param', 'start_date', 'end_date', 'brands', 'sizes', 'brandSizes', 'reports', 'totals', 'sizeIds', 'brandIds', 'depots', 'depotDistributors', 'depotIds', 'distributorIds')))->download('depot_wise_report.xlsx');
		}

		return view('reports.inventory.brand_wise.index', compact('param', 'start_date', 'end_date', 'brands', 'sizes', 'brandSizes', 'reports', 'totals', 'sizeIds', 'brandIds', 'depots', 'depotDistributors', 'depotIds', 'distributorIds', 'is_post'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function getBrandWiseDFStatus($param = 0, Request $request) {

		$brandIds = $sizeIds = $regionIds = [];

		$start_date = '01-01-2009';
		$end_date = Carbon::now()->format('d-m-Y');
		$divisionIds = $districtIds = $thanaIds = [];
		$depotIds = $distributorIds = [];
		$is_download = 0;
		$is_post = false;

		$divisions = collect([]);

		//$depotUsers = DepotUser::where('user_id', $authUserId)->select('depot_id')->get();

		if ($request->isMethod('post')) {
			$is_post = true;
			$is_download = $request->input('is_download');
			$brandIds = $request->input('brands');
			$sizeIds = $request->input('sizes');

			if ($request->has('start_date')) {
				$start_date = $request->input('start_date');
			}
			if ($request->has('end_date')) {
				$end_date = $request->input('end_date');
			}

			if ($param == 1) {
				if ($request->has('divisionIds')) {
					$divisionIds = $request->input('divisionIds');
				}
				if ($request->has('districtIds')) {
					$districtIds = $request->input('districtIds');
				}
				if ($request->has('thanaIds')) {
					$thanaIds = $request->input('thanaIds');
				}

			} elseif ($param == 2) {
				if ($request->has('depotIds')) {
					$depotIds = $request->input('depotIds');
				}
				if ($request->has('distributorIds')) {
					$distributorIds = $request->input('distributorIds');
				}
			} else {
				$regionIds = $request->input('regions');
			}
		}

		//$divisionIds = [4, 5];
		//$districtIds = [63, 32, 33];
		//$sizeIds = [3, 29, 24, 11];
		//$thanaIds = [344, 448, 458];

		if ($param == 1) {

			return $this->locationWiseDFBrand($start_date, $end_date, $brandIds, $sizeIds, $divisionIds, $districtIds, $thanaIds, $is_download, $is_post);
		} elseif ($param == 2) {

			return $this->depotWiseDFBrand($start_date, $end_date, $brandIds, $sizeIds, $depotIds, $distributorIds, $is_download, $is_post);
		} else {
			return $this->regionWiseDFBrand($start_date, $end_date, $regionIds, $brandIds, $sizeIds, $is_download, $is_post);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function migration($year) {
		//dd('Migrations Finis');
		foreach ([2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018] as $val) {
			$this->doMigration($val);

			dump($val . ' Finish;');

			sleep(2);
		}

	}
	public function doMigration($year) {
		//

		$tableStock = 'polar_temp.stock' . $year;
		$tableAllocation = 'polar_temp.allocation' . $year;

		$stocks = [];

		$stocksDetails = [];
		$stocksColl = DB::table($tableStock)->get();

		$sArray = $stocksColl->toArray();

		$j = 0;
		$level = 1;
		foreach ($sArray as $key => $stock) {
			$i = 0;

			$invoice_date = '';

			foreach ($stock as $k => $s) {

				if ($key == 0) {

					if ($i == 0) {
						$i++;
						continue;
					} elseif ($s == 'Total') {
						continue;
					} else {

						$brand = DB::table('brands')->where('short_code', $s)->first();
						$stocksDetails[$i]['brand_id'] = $brand->id;
						$stocksDetails[$i]['brand'] = $s;
					}
				} else if ($key == 1) {
					if ($i == 0) {
						$i++;
						continue;
					} else if ($s == '') {
						break;
					} else {

						$size = DB::table('sizes')->where('name', $s)->first();
						$stocksDetails[$i]['size_id'] = $size->id;
						$stocksDetails[$i]['size'] = $s;
					}
				} else {

					$stocks[$j]['invoice_no'] = 'Openning' . ($j - 1) . '-' . $year;
					$stocks[$j]['invoice_date'] = $invoice_date;
					$stocks[$j]['lc_date'] = $invoice_date;
					$stocks[$j]['currency'] = 'BDT';

					if ($i == 0) {
						$i++;
						$invoice_date = $s;
						continue;
					} else {

						//var_dump($s);

						if (strlen($s) > 0) {
							$stocks[$j]['no_of_type'] = isset($stocks[$j]['no_of_type']) ? $stocks[$j]['no_of_type'] + 1 : 1;

							$stocksDetails[$i]['level'] = $level - 2;
							$stocksDetails[$i]['qty'] = $s;
							$stocksDetails[$i]['receive_qty'] = $s;
							$stocks[$j]['total_item'] = isset($stocks[$j]['total_item']) ? $stocks[$j]['total_item'] + $s : $s;
							$stocks[$j]['details'][] = $stocksDetails[$i];

						}

						//dd($newStocks);

					}

				}
				$i++;
			}

			$j++;
			$level++;

		}

		//dd($stocks);

		$depots['East'] = 5;
		$depots['Tongi'] = 6;
		$depots['Mymensing'] = 7;
		$depots['Ashulia'] = 4;
		$depots['Hazaribag'] = 3;
		$depots['Jatrabari'] = 8;
		$depots['Bhairab'] = 9;
		$depots['Sylhet'] = 14;
		$depots['Comilla'] = 12;
		$depots['Noyakhali'] = 13;
		$depots['Ctg.'] = 10;
		$depots["Cox's bazar"] = 11;
		$depots['Bogra'] = 18;
		$depots['Rajshahi'] = 19;
		$depots['Rangpur'] = 20;
		$depots['Khulna'] = 15;
		$depots['Barishal'] = 17;
		$depots['Jessore'] = 16;
		$depots['RTM'] = 21;
		$depots['Central'] = 22;

		//DB::statement('truncate table polar_temp.stocks');
		//DB::statement('truncate table polar_temp.stock_details');
		//DB::statement('truncate table polar_temp.allocations');
		//DB::statement('truncate table polar_temp.allocation_details');
		//DB::statement('truncate table polar_temp.items');

		//DB::statement('truncate table stocks');
		//DB::statement('truncate table stock_details');
		//DB::statement('truncate table allocations');
		//DB::statement('truncate table allocation_details');

		foreach ($stocks as $stock) {

			$invoice_date = Carbon::parse($stock['invoice_date'])->format('Y-m-d');
			$insertStock['invoice_no'] = $stock['invoice_no'];
			$insertStock['invoice_date'] = $invoice_date;
			$insertStock['lc_date'] = $stock['lc_date'];
			$insertStock['no_of_type'] = $stock['no_of_type'];
			$insertStock['total_item'] = $stock['total_item'];
			$insertStock['is_opening'] = 1;
			$insertStock['is_allocated'] = 2;
			$insertStock['created_at'] = Carbon::now();
			$insertStock['updated_at'] = Carbon::now();

			$stock_id = DB::table('polar_temp.stocks')->insertGetId($insertStock);

			//$stock_id = 1;

			foreach ($stock['details'] as $ki => $detials) {

				//dd($detials);

				$stock_detail_id = DB::table('polar_temp.stock_details')->insertGetId(
					[
						'stock_id' => $stock_id,
						'brand_id' => $detials['brand_id'],
						'size_id' => $detials['size_id'],
						'qty' => $detials['qty'],
						'receive_qty' => $detials['receive_qty'],
					]
				);

				//$stock_detail_id = 1;

				$allocations = DB::select('select * from ' . $tableAllocation . ' where Size = ? AND stockId = ? ', [$detials['size'], $detials['level']]);
				//dd($allocations);

				$allocation_id = 0;
				foreach ($allocations as $allocation) {

					//dd($detials);
					$delivery_date = Carbon::parse($allocation->delivery_date)->format('Y-m-d');
					$insertAllocation = [];
					$insertAllocation['created_at'] = $delivery_date;
					$insertAllocation['stock_id'] = $stock_id;
					$insertAllocation['no_of_item'] = 1;
					//$insertAllocation['status'] = 'pending';
					$insertAllocation['status'] = 'receive';
					$insertAllocation['updated_at'] = Carbon::now();

					foreach ($depots as $key => $depot) {

						$depot_id = $depot;
						if (isset($allocation->{$key})) {
							$qty = $allocation->{$key};
						} else {
							$qty = '';
						}

						if (empty($qty)) {
							continue;
						}
						$insertAllocation['depot_id'] = $depot_id;
						$insertAllocation['total_qty'] = $qty;

						//chek depot already allocated
						$allocated = DB::table('polar_temp.allocations')->where('depot_id', $depot_id)->where('stock_id', $stock_id)->first();

						if ($allocated) {

							$allocation_id = $allocated->id;

							DB::table('polar_temp.allocations')
								->where('id', $allocation_id)
								->update([
									'no_of_item' => DB::raw('no_of_item + 1'),
									'total_qty' => DB::raw('total_qty + ' . $qty),
								]);
						} else {
							$insertAllocation['no_of_item'] = 1;
							$allocation_id = DB::table('polar_temp.allocations')->insertGetId($insertAllocation);
						}

						if ($allocation_id) {

							$insertAllocationDetails['allocation_id'] = $allocation_id;
							$insertAllocationDetails['stock_detail_id'] = $stock_detail_id;
							$insertAllocationDetails['qty'] = $qty;
							$insertAllocationDetails['receive_qty'] = $qty;
							$insertAllocationDetails['item_created'] = 1;

							$allocation_detail_id = DB::table('polar_temp.allocation_details')->insertGetId($insertAllocationDetails);

							$items = [];
							for ($i = 1; $i <= $qty; $i++) {

								$item['stock_detail_id'] = $stock_detail_id;
								$item['brand_id'] = $detials['brand_id'];
								$item['size_id'] = $detials['size_id'];
								$item['depot_id'] = $depot_id;
								$item['allocation_detail_id'] = $allocation_detail_id;
								$item['freeze_status'] = 'fresh';
								$item['longevity_period'] = '7 year';
								//$item['item_status'] = 'continue';
								$item['created_at'] = $delivery_date;
								$item['updated_at'] = Carbon::now();

								array_push($items, $item);

							}

							DB::table('polar_temp.items')->insert($items);
						}
					}

				}

			}

		}

		//dd('Done: ' . $year);
	}
}
