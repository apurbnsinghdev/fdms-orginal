<?php

namespace App\Http\Controllers;

use App\ProblemType;
use Illuminate\Http\Request;

class ProblemTypesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$problem_types = ProblemType::orderBy('name')->get();
		return view('problem_types.index', compact('problem_types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('problem_types.create');
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
			'name' => 'required|unique:problem_types',
		]);

		$problem_types = ProblemType::create($data);
		if ($problem_types) {
			$message = "You have successfully created";
			return redirect()->route('problem_types.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('problem_types.index', [])
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
		$problem_types = ProblemType::findOrFail($id);
		return view('problem_types.edit', compact('problem_types'));
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
			'name' => 'required|unique:problem_types,name,' . $id,
		]);

		$problem_types = ProblemType::where('id', $id)->update($data);
		if ($problem_types) {
			$message = "You have successfully updated";
			return redirect()->route('problem_types.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Nothing changed!! Please try again";
			return redirect()->route('problem_types.index', [])
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
		$msg = $this->checkUses($id, 'problem_type_id', 'ComplainType');
		if ($msg != 'no') {
			return $msg;
		}
		$problem_types = ProblemType::destroy($id);
		if ($problem_types) {
			$message = "You have successfully deleted";
			return redirect()->route('problem_types.index', [])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('problem_types.index', [])
				->with('flash_danger', $message);
		}
	}
}
