<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$suppliers = Supplier::get();
		return view('suppliers.index', compact('suppliers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('suppliers.create');
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
			'name' => 'required|unique:suppliers',
		]);

		$suppliers = Supplier::create($data);
		if ($suppliers) {
			$message = "You have successfully created";
			return redirect()->route('suppliers.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('suppliers.index', [])
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
		$suppliers = Supplier::findOrFail($id);
		return view('suppliers.edit', compact('suppliers'));
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
			'name' => 'required|unique:suppliers,name,' . $id,
		]);

		$suppliers = Supplier::where('id', $id)->update($data);
		if ($suppliers) {
			$message = "You have successfully updated";
			return redirect()->route('suppliers.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Nothing changed!! Please try again";
			return redirect()->route('suppliers.index', [])
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
		$suppliers = Supplier::destroy($id);
		if ($suppliers) {
			$message = "You have successfully deleted";
			return redirect()->route('suppliers.index', [])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('suppliers.index', [])
				->with('flash_danger', $message);
		}
	}
}
