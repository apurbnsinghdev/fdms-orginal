<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Exports\BrandExport;
use Illuminate\Http\Request;

class BrandsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $brands = Brand::get();
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('brands.create');
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
            'name' => 'required|unique:brands',
            'short_code' => 'required|unique:brands',
        ]);

        $brands = Brand::create($data);
        if ($brands) {
            $message = "You have successfully created";
            return redirect()->route('brands.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('brands.index', [])
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
        $brands = Brand::findOrFail($id);
        return view('brands.edit', compact('brands'));
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
            'name' => 'required|unique:brands,name,' . $id,
            'short_code' => 'required|unique:brands,short_code,' . $id,
        ]);

        $brands = Brand::where('id', $id)->update($data);
        if ($brands) {
            $message = "You have successfully updated";
            return redirect()->route('brands.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('brands.index', [])
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
        $msg = $this->checkUses($id, 'brand_id', 'StockDetail');
        if ($msg != 'no') {
            return $msg;
        }
        $brands = Brand::destroy($id);
        if ($brands) {
            $message = "You have successfully deleted";
            return redirect()->route('brands.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('brands.index', [])
                ->with('flash_danger', $message);
        }
    }

    public function download() {

        return (new BrandExport())->download('brands.xlsx');
    }
}
