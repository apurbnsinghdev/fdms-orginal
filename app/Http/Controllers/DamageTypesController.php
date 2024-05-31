<?php

namespace App\Http\Controllers;

use App\DamageType;
use App\Exports\DamageTypeExport;
use Illuminate\Http\Request;

class DamageTypesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $damage_types = DamageType::get();
        return view('damage_types.index', compact('damage_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('damage_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = $request->all();
        $request->validate([
            'name' => 'required|unique:damage_types',
        ]);
        $damage_types = DamageType::create($data);
        if ($damage_types) {
            $message = "You have successfully created";
            return redirect()->route('damage_types.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('damage_types.index', [])
                ->with('flash_danger', $message);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $damage_types = DamageType::findOrFail($id);
        return view('damage_types.edit', compact('damage_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = $request->except('_method', '_token');
        $request->validate([
            'name' => 'required|unique:damage_types,name,' . $id,
        ]);

        $damage_types = DamageType::where('id', $id)->update($data);
        if ($damage_types) {
            $message = "You have successfully updated";
            return redirect()->route('damage_types.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('damage_types.index', [])
                ->with('flash_warning', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $damage_types = DamageType::destroy($id);
        if ($damage_types) {
            $message = "You have successfully deleted";
            return redirect()->route('damage_types.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('damage_types.index', [])
                ->with('flash_danger', $message);
        }
    }

    public function download() {

        return (new DamageTypeExport())->download('DamageTypes.xlsx');
    }
}
