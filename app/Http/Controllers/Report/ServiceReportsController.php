<?php

namespace App\Http\Controllers\Report;

use App\DamageType;
use App\Exports\ComplainExport;
use App\Http\Controllers\Controller;
use App\ProblemType;
use App\Repositories\Models\DamageApplicationRepository;
use App\Repositories\Models\DepotRepository;
use App\Repositories\Models\DfProblemRepository;
use App\Repositories\Models\ProblemTypeRepository;
use App\Repositories\Models\SizeRepository;
use App\Repositories\Models\TechnicianRepository;
use App\Repositories\Models\ZoneRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ServiceReportsController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {

		$report = collect([]);
		$token = false;
		$isDownload = false;
		$isPost = false;

		$authUserId = auth()->user()->id;
		$depotRepository = new DepotRepository;
		$depotsObject = $depotRepository->getRegionWiseLists($authUserId);

		$depots = $depotsObject->pluck('id')->toArray();
		$dfProblemRepository = new DfProblemRepository;

		if ($request->isMethod('post')) {
			$request->validate([
				'token' => 'required|numeric',
			]);
			$isPost = true;
			$token = $request->input('token');
			$report = $dfProblemRepository->findToken($token, $depots);

			//dd($report->toArray());

			if ($request->has('download')) {
				$isDownload = true;
				$fileName = 'Token-' . $token;
				$pdf = \domPDF::loadView('reports.services.token_pdf', compact('report', 'token', 'isDownload'));
				$customPaper = array(0, 0, 950, 950);
				return $pdf->setPaper($customPaper, 'landscape')->setWarnings(false)->download($fileName . '.pdf');
			}
		}
		return view('reports.services.token', compact('token', 'report', 'isDownload', 'isPost'));

	}

	public function dfWiseComplain(Request $request) {

		$start_date = '01-01-2009';
		$end_date = Carbon::now()->format('d-m-Y');

		$regionIds = $depotIds = $codeIds = $typeIds = [];

		$authUserId = auth()->user()->id;

		$zoneRepository = new ZoneRepository;
		$regions = $zoneRepository->getRegions($authUserId);

		$depotRepository = new DepotRepository;
		$depotsObject = $depotRepository->getRegionWiseLists($authUserId);

		$depots = [];
		foreach ($depotsObject as $depot) {
			$depots[$depot->zone_name][$depot->id] = $depot->name;
		}
		$ProblemTypeRepository = new ProblemTypeRepository;
		$problemTypes = $ProblemTypeRepository->all()->pluck('name', 'id');
		//dd($problemTypes);

		$reports = collect([]);
		$problems = [];
		$totalProblemTypes = [];

		if ($request->isMethod('post')) {

			if ($request->has('is_download')) {
				$is_download = $request->input('is_download');
			}

			if ($request->has('start_date')) {
				$start_date = $request->input('start_date');
			}

			if ($request->has('end_date')) {
				$end_date = $request->input('end_date');
			}

			if ($request->has('regionIds')) {
				$regionIds = $request->input('regionIds');
			}

			if ($request->has('depotIds')) {
				$depotIds = $request->input('depotIds');
			}

			if ($request->has('codeIds')) {
				$codeIds = $request->input('codeIds');
			}

			if ($request->has('typeIds')) {
				$typeIds = $request->input('typeIds');
			}

			$dfProblemRepository = new DfProblemRepository;

			$reports = $dfProblemRepository->getDfWiseComplains($start_date, $end_date, $regionIds, $depotIds, $codeIds, $typeIds);

			foreach ($reports as $report) {
				$totalProblemTypes[$report->problem_type_id] = 0;
				$problems[$report->df_code][$report->problem_type_id] = $report->no_of_problem;
			}
		}

		$dfcodes = [];
		$dfCodesObj = $depotRepository->getDepotCodeLists($authUserId, $regionIds, $depotIds);

		foreach ($dfCodesObj as $depot) {
			$dfcodes[$depot->name][$depot->df_code] = $depot->df_code;
		}

		if (isset($is_download) AND $is_download > 0) {
			$reportView = 'reports.services.df_wise_complain_report';
			return (new ComplainExport($reportView, compact('reports', 'problems', 'totalProblemTypes', 'problemTypes')))->download('df_wise_complain_report.xlsx');
		}

		return view('reports.services.df_wise_complain', compact('start_date', 'end_date', 'regions', 'depots', 'dfcodes', 'problemTypes', 'regionIds', 'depotIds', 'codeIds', 'typeIds', 'reports', 'problems', 'is_download', 'totalProblemTypes'));

	}

	public function sizeWiseComplain(Request $request) {

		$currentYear = Carbon::now()->format('Y');

		$years = $months = $regionIds = $depotIds = $sizeIds = [];

		$authUserId = auth()->user()->id;

		$zoneRepository = new ZoneRepository;
		$regions = $zoneRepository->getRegions($authUserId);

		$size = new SizeRepository;
		$sizes = $size->getAll()->pluck('name', 'name');

		$depotRepository = new DepotRepository;
		$depotsObject = $depotRepository->getRegionWiseLists($authUserId);

		$depots = [];
		foreach ($depotsObject as $depot) {
			$depots[$depot->zone_name][$depot->id] = $depot->name;
		}

		$reports = collect([]);
		$size_list = collect([]);
		$reportData = [];
		if ($request->isMethod('post')) {
			if ($request->has('is_download')) {
				$is_download = $request->input('is_download');
			}
			if ($request->has('years')) {
				$years = $request->input('years');
			}

			if ($request->has('months')) {
				$months = $request->input('months');
			}

			if ($request->has('regionIds')) {
				$regionIds = $request->input('regionIds');
				$regionsArr = $regionIds;
			} else {
				$regionsArr = array_keys($regions->toArray());
			}

			if ($request->has('depotIds')) {
				$depotIds = $request->input('depotIds');
			}

			if ($request->has('sizeIds')) {
				$sizeIds = $request->input('sizeIds');
			}
			$dfProblemRepository = new DfProblemRepository;
			$reportDataObj = $dfProblemRepository->getDfSizeWiseComplains($years, $months, $regionsArr, $depotIds, $sizeIds);
			$size_list = $reportDataObj->unique('df_size')->pluck('df_size');
			foreach ($reportDataObj as $val) {
				$reportData[$val->year][$val->month][$val->df_size] = $val->no_of_problem;
			}
		}

		if (isset($is_download) and $is_download > 0) {
			$reportView = 'reports.services.size_wise_complain_report';
			return (new ComplainExport($reportView, compact('reportData', 'size_list')))->download('size_wise_complain_report.xlsx');
		}

		return view('reports.services.size_wise_complain', compact('years', 'months', 'regions', 'depots', 'sizes', 'regionIds', 'depotIds', 'sizeIds', 'reportData', 'size_list', 'is_download'));

	}

	public function typeWiseComplain(Request $request) {
		$currentYear = Carbon::now()->format('Y');

		$years = $months = $regionIds = $depotIds = $typeIds = [];

		$authUserId = auth()->user()->id;

		$zoneRepository = new ZoneRepository;
		$regions = $zoneRepository->getRegions($authUserId);

		$problemTypesObj = ProblemType::orderBy('name');
		$problemTypes = $problemTypesObj->pluck('name', 'id');

		$depotRepository = new DepotRepository;
		$depotsObject = $depotRepository->getRegionWiseLists($authUserId);

		$depots = [];
		foreach ($depotsObject as $depot) {
			$depots[$depot->zone_name][$depot->id] = $depot->name;
		}

		$reportData = [];

		if ($request->isMethod('post')) {

			if ($request->has('is_download')) {
				$is_download = $request->input('is_download');
			}

			if ($request->has('years')) {
				$years = $request->input('years');
			}

			if ($request->has('months')) {
				$months = $request->input('months');
			}

			if ($request->has('regionIds')) {
				$regionIDs = $request->input('regionIds');
				$regionIds = $regionIDs;

			} else {
				$regionIDs = $regions->keys()->toArray();
			}

			if ($request->has('depotIds')) {
				$depotIds = $request->input('depotIds');
			}

			if ($request->has('typeIds')) {
				$typeIds = $request->input('typeIds');
			}

			$dfProblemRepository = new DfProblemRepository;
			$reportDataObj = $dfProblemRepository->getTypeWiseComplains($years, $months, $regionIDs, $depotIds, $typeIds);

			//dd($reportDataObj->toArray());

			$typeColumns = $reportDataObj->unique('problem_type_id')->pluck('problem_type_id');

			$type_columns = $problemTypesObj->get()->whereIn('id', $typeColumns);

			foreach ($reportDataObj as $val) {
				if (isset($reportData[$val->year][$val->month][$val->problem_type_id])) {
					$reportData[$val->year][$val->month][$val->problem_type_id] = $reportData[$val->year][$val->month][$val->problem_type_id] + $val->no_of_problem;
				} else {
					$reportData[$val->year][$val->month][$val->problem_type_id] = $val->no_of_problem;
				}
			}
		}

		//dd($reportData);

		if (isset($is_download) AND $is_download > 0) {
			$reportView = 'reports.services.type_wise_complain_report';
			return (new ComplainExport($reportView, compact('reportData', 'type_columns')))->download('type_wise_complain_report.xlsx');
		}

		return view('reports.services.type_wise_complain', compact('years', 'months', 'regions', 'depots', 'sizes', 'problemTypes', 'regionIds', 'depotIds', 'typeIds', 'reportData', 'type_columns', 'is_download'));
	}

	public function dateWiseComplain(Request $request) {
		$start_date = '01-01-2009';

		$end_date = Carbon::now()->format('d-m-Y');

		$regionIds = $depotIds = $sizeIds = $typeIds = [];

		$authUserId = auth()->user()->id;

		$zoneRepository = new ZoneRepository;
		$regions = $zoneRepository->getRegions($authUserId);

		$problemTypes = ProblemType::orderBy('name')->pluck('name', 'id');

		$size = new SizeRepository;
		$sizes = $size->getAll()->pluck('name', 'id');

		$depotRepository = new DepotRepository;
		$depotsObject = $depotRepository->getRegionWiseLists($authUserId);

		$depots = [];
		foreach ($depotsObject as $depot) {
			$depots[$depot->zone_name][$depot->id] = $depot->name;
		}

		$reportData = [];
		$size_list = collect([]);
		if ($request->isMethod('post')) {
			if ($request->has('is_download')) {
				$is_download = $request->input('is_download');
			}
			if ($request->has('start_date')) {
				$start_date = $request->input('start_date');
			}

			if ($request->has('end_date')) {
				$end_date = $request->input('end_date');
			}

			if ($request->has('regionIds')) {
				$regionIds = $request->input('regionIds');
				$regionsArr = $regionIds;
			} else {
				$regionsArr = array_keys($regions->toArray());
			}

			if ($request->has('depotIds')) {
				$depotIds = $request->input('depotIds');
			}

			if ($request->has('sizeIds')) {
				$sizeIds = $request->input('sizeIds');
			}

			if ($request->has('typeIds')) {
				$typeIds = $request->input('typeIds');
			}

			$dfProblemRepository = new DfProblemRepository;
			$reportDataObj = $dfProblemRepository->getDateWiseComplains($start_date, $end_date, $regionsArr, $depotIds, $typeIds);
			//dd($reportDataObj->toArray());
			$size_list = $reportDataObj->unique('df_size')->pluck('df_size');
			foreach ($reportDataObj as $val) {
				$reportData[$val->dt][$val->df_size] = $val->no_of_problem;
			}
		}

		if (isset($is_download) and $is_download > 0) {
			$reportView = 'reports.services.date_wise_complain_report';
			return (new ComplainExport($reportView, compact('reportData', 'size_list')))->download('date_wise_complain.xlsx');
		}

		return view('reports.services.date_wise_complain', compact('start_date', 'end_date', 'regions', 'depots', 'sizes', 'problemTypes', 'regionIds', 'depotIds', 'sizeIds', 'typeIds', 'reportData', 'size_list', 'is_download'));

	}

	public function longPendingComplain(Request $request) {
		$authUserId = auth()->user()->id;

		$depotRepository = new DepotRepository;
		$depotsObject = $depotRepository->getRegionWiseLists($authUserId);
		$depotIds = $depotsObject->pluck('id');

		$dfProblemRepository = new DfProblemRepository;
		$reportData = $dfProblemRepository->getLongPendingComplains($depotIds);

		//dd($reportData);

		if ($request->isMethod('post')) {
			$is_download = 0;
			if ($request->has('is_download')) {
				$is_download = $request->input('is_download');
			}

			$reportView = 'reports.services.long_pending_complain_report';
			return (new ComplainExport($reportView, compact('reportData', 'is_download')))->download('long_pending_complain_report.xlsx');

		}

		return view('reports.services.long_pending_complain', compact('reportData'));

	}

	public function jobCardComplain(Request $request) {
		$start_date = '01-01-2009';

		$end_date = Carbon::now()->format('d-m-Y');

		$regionIds = $depotIds = $technicianIds = [];

		$authUserId = auth()->user()->id;

		$zoneRepository = new ZoneRepository;
		$regions = $zoneRepository->getRegions($authUserId);

		$depotRepository = new DepotRepository;
		$depotsObject = $depotRepository->getRegionWiseLists($authUserId);

		$depotIDs = $depotsObject->pluck('id');

		$technicians = [];
		$technicianObj = new TechnicianRepository;
		$technicianResult = $technicianObj->getDepotTechnicians($regionIds, $depotIDs);
		foreach ($technicianResult as $technician) {
			$technicians[$technician->depot][$technician->id] = $technician->name;
		}

		$depots = [];
		foreach ($depotsObject as $depot) {
			$depots[$depot->zone_name][$depot->id] = $depot->name;
		}

		$reportData = collect([]);
		if ($request->isMethod('post')) {

			if ($request->has('is_download')) {
				$is_download = $request->input('is_download');
			}
			if ($request->has('start_date')) {
				$start_date = $request->input('start_date');
			}

			if ($request->has('end_date')) {
				$end_date = $request->input('end_date');
			}

			if ($request->has('regionIds')) {
				$regionIds = $request->input('regionIds');
				$regionsIDs = $regionIds;
			} else {
				$regionsIDs = array_keys($regions->toArray());
			}

			if ($request->has('depotIds')) {
				$depotIds = $request->input('depotIds');
				$depotIDs = $depotIds;
			}

			if ($request->has('technicianIds')) {
				$technicianIds = $request->input('technicianIds');
			}

			$dfProblemRepository = new DfProblemRepository;
			$reportData = $dfProblemRepository->getJobCard($start_date, $end_date, $regionsIDs, $depotIDs, $technicianIds);

		}

		if (isset($is_download) and $is_download > 0) {
			$reportView = 'reports.services.job_card_report';
			return (new ComplainExport($reportView, compact('reportData', 'size_list', 'is_download')))->download('job_card.xlsx');
		}

		return view('reports.services.job_card', compact('start_date', 'end_date', 'regions', 'depots', 'technicians', 'regionIds', 'depotIds', 'technicianIds', 'reportData', 'is_download'));
	}

	public function damagedLists(Request $request) {

		$start_date = '01-01-2009';
		$end_date = Carbon::now()->format('d-m-Y');

		$regionIds = $depotIds = $sizeIds = $damageTypeIds = [];

		$authUserId = auth()->user()->id;

		$zoneRepository = new ZoneRepository;
		$regions = $zoneRepository->getRegions($authUserId);

		$damageTypes = DamageType::orderBy('name')->pluck('name', 'id');

		$depotRepository = new DepotRepository;
		$depotsObject = $depotRepository->getRegionWiseLists($authUserId);

		$depots = [];
		foreach ($depotsObject as $depot) {
			$depots[$depot->zone_name][$depot->id] = $depot->name;
		}
		$reportData = collect([]);
		if ($request->isMethod('post')) {
			if ($request->has('is_download')) {
				$is_download = $request->input('is_download');
			}
			if ($request->has('start_date')) {
				$start_date = $request->input('start_date');
			}

			if ($request->has('end_date')) {
				$end_date = $request->input('end_date');
			}

			if ($request->has('regionIds')) {
				$regionIds = $request->input('regionIds');
				$regionsArr = $regionIds;
			} else {
				$regionsArr = array_keys($regions->toArray());
			}

			if ($request->has('depotIds')) {
				$depotIds = $request->input('depotIds');
			}

			if ($request->has('damageTypeIds')) {
				$damageTypeIds = $request->input('damageTypeIds');
			}
			$damageApplicationRepository = new DamageApplicationRepository();
			$reportData = $damageApplicationRepository->getDamageList($start_date, $end_date, $regionsArr, $depotIds, $damageTypeIds);
			//dd($reportData->toArray());
		}

		if (isset($is_download) and $is_download > 0) {
			$reportView = 'reports.services.damage_list_report';
			return (new ComplainExport($reportView, compact('reportData')))->download('date_wise_damaged_lists.xlsx');
		}

		return view('reports.services.damage_list', compact('start_date', 'end_date', 'regions', 'depots', 'damageTypes', 'regionIds', 'depotIds', 'damageTypeIds', 'reportData', 'is_download'));

	}

}
