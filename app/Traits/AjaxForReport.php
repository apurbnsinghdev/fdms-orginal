<?php
namespace App\Traits;
use App\Location;
use App\Repositories\Models\DepotRepository;
use App\Repositories\Models\TechnicianRepository;
use Illuminate\Http\Request;
trait AjaxForReport {

    public function getMultiDistricts(Request $request) {

        if ($request->has('divisionIds')) {
            $multiple = $request->input('multiple');
            $divisionIds = $request->input('divisionIds');
            //return $multiple;
            if ($multiple) {
                $locations = \App\Location::whereNull('parent_id')->whereIn('id', $divisionIds);
            } else {

                $locations = \App\Location::whereNull('parent_id')->where('id', $divisionIds);
            }
            $locations->with(['children' => function ($q) {
                return $q->with('children');
            }]);

            return $locations->get();
        } else {
            return collect([]);
        }

    }
    public function getMultiThanas(Request $request) {
        if ($request->has('districtIds')) {
            $multiple = $request->input('multiple');
            $districtIds = $request->input('districtIds');
            //return $multiple;
            if ($multiple) {
                $locations = \App\Location::whereIn('id', $districtIds);
            } else {

                $locations = \App\Location::where('id', $districtIds);
            }
            $locations->with(['children' => function ($q) {
                return $q->with('children');
            }]);

            return $locations->get();
        } else {
            return collect([]);
        }
    }

    public function getMultiDistributor(Request $request) {
        if ($request->has('depotIds')) {
            $multiple = $request->input('multiple');
            $depotIds = $request->input('depotIds');

            $depotRepository = new DepotRepository;
            $distributors = $depotRepository->distributors($depotIds);
            return $distributors;

        } else {
            return collect([]);
        }
    }

    public function getRegionWiseDepots(Request $request) {

        if ($request->has('regionIds')) {

            $multiple = $request->input('multiple');
            $regionIds = $request->input('regionIds');

            $depotRepository = new DepotRepository;
            $depotsObject = $depotRepository->getRegionWiseLists(auth()->user()->id, $regionIds);

            $depots = [];
            foreach ($depotsObject as $depot) {
                $depots[$depot->zone_name][$depot->id] = $depot->name;
            }

            return $depots;
        } else {
            return collect([]);
        }
    }

    public function getDepotCodes(Request $request) {

        if ($request->has('regionIds') or $request->has('depotIds')) {

            $multiple = $request->input('multiple');
            $regionIds = $request->input('regionIds');
            $depotIds = $request->input('depotIds');

            $depotRepository = new DepotRepository;
            $depotsObject = $depotRepository->getDepotCodeLists(0, $regionIds, $depotIds);
            $depots = [];
            foreach ($depotsObject as $depot) {
                $depots[$depot->name][$depot->df_code] = $depot->df_code;
            }
            return $depots;

        } else {
            return collect([]);
        }
    }

    public function getMultiTechnician(Request $request) {

        if ($request->has('regionIds') or $request->has('depotIds')) {

            $multiple = $request->input('multiple');
            $regionIds = $request->input('regionIds');
            $depotIds = $request->input('depotIds');

            $technicianObj = new TechnicianRepository;
            $technicianResult = $technicianObj->getDepotTechnicians($regionIds, $depotIds);
            $technicians = [];
            foreach ($technicianResult as $technician) {
                $technicians[$technician->depot][$technician->id] = $technician->name;
            }
            return $technicians;

        } else {
            return collect([]);
        }
    }
}

?>