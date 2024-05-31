<?php

namespace App\Http\Controllers;
use App\Exports\LocationExport;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocationsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param = '0') {
        $obj = Location::where('level', $param);
        if ($param == '1') {
            $obj->with(['parent']);
        } else if ($param == '2') {
            $obj->with(['parent' => function ($q) {
                return $q->with('parent');
            }]);
        }
        $locations = $obj->get();
        return view('locations.index', compact('param', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($param = '0') {
        $divisions = [];
        if ($param == '1' || $param == '2') {
            $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
        }
        return view('locations.create', compact('param', 'divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->except('division_id');

        if ($data['level'] == '2') {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('locations')->where(function ($query) use ($request) {
                        return $query->where('parent_id', $request->parent_id);
                    }),
                ],
                'parent_id' => 'required|numeric',
            ]);
        } elseif ($data['level'] == '1') {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('locations')->where(function ($query) use ($request) {
                        return $query->where('level', $request->level);
                    }),
                ],
                'parent_id' => 'required|numeric',
            ]);
        } else {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('locations')->where(function ($query) use ($request) {
                        return $query->where('level', $request->level);
                    }),
                ],
                'parent_id' => 'nullable|numeric',
            ]);
        }

        $locations = Location::create($data);
        if ($locations) {
            $message = "You have successfully created";
            return redirect()->route('locations.index', [$data['level'] ? $data['level'] : ''])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('locations.index', [$data['level'] ? $data['level'] : ''])
                ->with('flash_danger', $message);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $param = '0') {
        $locations = Location::with('parent')->findOrFail($id);
        $divisions = [];
        $districts = [];
        if ($param == '1') {
            $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
        } elseif ($param == '2') {
            $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
            $districts = Location::where('parent_id', $locations->parent->parent_id)->pluck('name', 'id');
        }
        //dd($districts);
        return view('locations.edit', compact('param', 'locations', 'divisions', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = $request->except('division_id', '_method', '_token');

        if ($data['level'] == '2') {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('locations')->where(function ($query) use ($request, $id) {
                        return $query->where('id', '!=', $id)->where('parent_id', $request->parent_id);
                    }),
                ],
                'parent_id' => 'required|numeric',
            ]);
        } elseif ($data['level'] == '1') {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('locations')->where(function ($query) use ($request, $id) {
                        return $query->where('id', '!=', $id)->where('level', $request->level);
                    }),
                ],
                'parent_id' => 'required|numeric',
            ]);
        } else {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('locations')->where(function ($query) use ($request, $id) {
                        return $query->where('id', '!=', $id)->where('level', $request->level);
                    }),
                ],
                'parent_id' => 'nullable|numeric',
            ]);
        }

        $locations = Location::where('id', $id)->update($data);
        if ($locations) {
            $message = "You have successfully updated";
            return redirect()->route('locations.index', [$data['level'] ? $data['level'] : ''])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('locations.index', [$data['level'] ? $data['level'] : ''])
                ->with('flash_warning', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $level = $request->level;
        if ($level == '0') {
            $column = 'division_id';
        } elseif ($level == '1') {
            $column = 'district_id';
        } elseif ($level == '2') {
            $column = 'thana_id';
        }
        $msg = $this->checkUses($id, $column, 'Depot');
        if ($msg != 'no') {
            return $msg;
        }

        $locations = Location::find($id);
        $query = $locations->delete();
        if ($query) {
            $message = "You have successfully deleted";
            return redirect()->route('locations.index', [$level ? $level : ''])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('locations.index', [$level ? $level : ''])
                ->with('flash_danger', $message);
        }
    }

    public function download($param = '0') {
        if ($param == '0') {
            $filename = 'Division.xlsx';
        } else if ($param == '1') {
            $filename = 'District.xlsx';
        } else {
            $filename = 'Thana.xlsx';
        }

        return (new LocationExport($param))->download($filename);
    }
}
