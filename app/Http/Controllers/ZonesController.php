<?php

namespace App\Http\Controllers;
use App\Exports\ZoneExport;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ZonesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param = '0') {
        $obj = Zone::where('level', $param);
        if ($param == '1') {
            $obj->with(['parent']);
        }
        if (!$param) {
            $obj->orderByRaw('CAST(code AS SIGNED INTEGER) ASC');
        }
        $zones = $obj->get();
        return view('zones.index', compact('param', 'zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($param = '0') {
        $regions = [];
        if ($param == '1' || $param == '2') {
            $regions = Zone::whereNull('parent_id')->pluck('name', 'id');
        }
        return view('zones.create', compact('param', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->except('division_id');

        if ($data['level'] == '1') {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('zones')->where(function ($query) use ($request) {
                        return $query->where('level', $request->level);
                    }),
                ],
                'parent_id' => 'required|numeric',
            ]);
        } else {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('zones')->where(function ($query) use ($request) {
                        return $query->where('level', $request->level);
                    }),
                ],
                'parent_id' => 'nullable|numeric',
                'code' => 'required|max:2|unique:zones',
            ]);
        }

        $zones = Zone::create($data);
        if ($zones) {
            $message = "You have successfully created";
            return redirect()->route('zones.index', [$data['level'] ? $data['level'] : ''])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('zones.index', [$data['level'] ? $data['level'] : ''])
                ->with('flash_danger', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('zones.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $param = '0') {
        $zones = Zone::with('parent')->findOrFail($id);
        $regions = [];
        if ($param == '1') {
            $regions = Zone::whereNull('parent_id')->pluck('name', 'id');
        }
        //dd($districts);
        return view('zones.edit', compact('param', 'zones', 'regions'));
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

        if ($data['level'] == '1') {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('zones')->where(function ($query) use ($request, $id) {
                        return $query->where('id', '!=', $id)->where('level', $request->level);
                    }),
                ],
                'parent_id' => 'required|numeric',
            ]);
        } else {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('zones')->where(function ($query) use ($request, $id) {
                        return $query->where('id', '!=', $id)->where('level', $request->level);
                    }),
                ],
                'parent_id' => 'nullable|numeric',
                'code' => 'required|max:2|unique:zones,code,' . $id,
            ]);
        }

        $zones = Zone::where('id', $id)->update($data);
        if ($zones) {
            $message = "You have successfully updated";
            return redirect()->route('zones.index', [$data['level'] ? $data['level'] : ''])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('zones.index', [$data['level'] ? $data['level'] : ''])
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
            $column = 'region_id';
        } elseif ($level == '1') {
            $column = 'area_id';
        }
        $msg = $this->checkUses($id, $column, 'Depot');
        if ($msg != 'no') {
            return $msg;
        }
        $zones = Zone::find($id);
        $query = $zones->delete();
        if ($query) {
            $message = "You have successfully deleted";
            return redirect()->route('zones.index', [$level ? $level : ''])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('zones.index', [$level ? $level : ''])
                ->with('flash_danger', $message);
        }
    }

    public function download($param = '0') {
        if ($param == '0') {
            $filename = 'Region.xlsx';
        } else if ($param == '1') {
            $filename = 'Area.xlsx';
        }

        return (new ZoneExport($param))->download($filename);
    }
}
