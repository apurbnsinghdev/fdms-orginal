<?php

namespace App\Http\Controllers;
use App\Designation;
use App\Exports\DesignationExport;
use Illuminate\Http\Request;

class DesignationsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$designations = Designation::orderBy('sequence')->get();
		return view('designations.index', compact('designations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('designations.create');
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
			'title' => 'required|unique:designations,title',
			'short_name' => 'required|max:10|unique:designations,short_name',
			'status' => 'required',
		]);
		$data['sequence'] = Designation::max('sequence') + 1;
		$designations = Designation::create($data);
		if ($designations) {
			$message = "You have successfully created";
			return redirect()->route('designations.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('designations.index', [])
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
		$designations = Designation::findOrFail($id);
		return view('designations.edit', compact('designations'));
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
			'title' => 'required|unique:designations,title,' . $id,
			'short_name' => 'required|max:10|unique:designations,short_name,' . $id,
			'status' => 'required',
		]);

		$designations = Designation::where('id', $id)->update($data);
		if ($designations) {
			$message = "You have successfully updated";
			return redirect()->route('designations.index', [])
				->with('flash_success', $message);

		} else {
			$message = "Nothing changed!! Please try again";
			return redirect()->route('designations.index', [])
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
		$msg = $this->checkUses($id, 'designation_id', 'User');
		if ($msg != 'no') {
			return $msg;
		}
		$designations = Designation::destroy($id);
		if ($designations) {
			$message = "You have successfully deleted";
			return redirect()->route('designations.index', [])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('designations.index', [])
				->with('flash_danger', $message);
		}
	}

	public function sort(Request $request) {
		$newData = [];
		if ($request->isMethod('put')) {
			$data = $request->except('_method', '_token');
			$newSortArr = $data['sort'];
			foreach ($newSortArr as $key => $value) {
				Designation::where('id', $value)->update(['sequence' => $key + 1]);
			}
			$message = "You have successfully updated";
			return redirect()->route('designations.index', [])
				->with('flash_success', $message);
		} else {
			$designation = new Designation();
			$designations = $designation->orderBy('sequence')->pluck('title', 'id');
			return view('designations.sort', compact('designations'));
		}
	}

	public function download() {
		return (new DesignationExport())->download('designation.xlsx');
	}
}
