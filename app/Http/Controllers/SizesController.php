<?php

namespace App\Http\Controllers;
use App\Exports\SizeExport;
use App\Size;
use Illuminate\Http\Request;

class SizesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sizes = Size::orderBy('name')->get();
        return view('sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('sizes.create');
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
            'name' => 'required|numeric|unique:sizes',
            'rent_amount' => 'required|numeric',
            'installment' => 'required|numeric',
        ]);

        $sizes = Size::create($data);
        if ($sizes) {
            $message = "You have successfully created";
            return redirect()->route('sizes.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('sizes.index', [])
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
        $sizes = Size::findOrFail($id);
        return view('sizes.edit', compact('sizes'));
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
            'name' => 'required|numeric|unique:sizes,name,' . $id,
            'rent_amount' => 'required|numeric',
            'installment' => 'required|numeric',
        ]);

        $sizes = Size::where('id', $id)->update($data);
        if ($sizes) {
            $message = "You have successfully updated";
            return redirect()->route('sizes.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('sizes.index', [])
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
        $msg = $this->checkUses($id, 'size_id', 'StockDetail');
        if ($msg != 'no') {
            return $msg;
        }
        $sizes = Size::destroy($id);
        if ($sizes) {
            $message = "You have successfully deleted";
            return redirect()->route('sizes.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('sizes.index', [])
                ->with('flash_danger', $message);
        }
    }

    public function download() {

        return (new SizeExport())->download('size.xlsx');
    }
}
