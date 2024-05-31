<?php

namespace App\Http\Controllers;

use App\Model;
use Illuminate\Http\Request;

class ModelsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$models = Model::get();
		return view('models.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('models.create');
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
			'code' => 'required|unique:models',
		]);

		$models = Model::create($data);
		if ($models) {
			$message = "You have successfully created";
			return redirect()->route('models.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('models.index', [])
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
		$models = Model::findOrFail($id);
		return view('models.edit', compact('models'));
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
			'code' => 'required|unique:models,code,' . $id,
		]);

		$models = Model::where('id', $id)->update($data);
		if ($models) {
			$message = "You have successfully updated";
			return redirect()->route('models.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Nothing changed!! Please try again";
			return redirect()->route('models.index', [])
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
		$models = Model::destroy($id);
		if ($models) {
			$message = "You have successfully deleted";
			return redirect()->route('models.index', [])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('models.index', [])
				->with('flash_danger', $message);
		}
	}
}
