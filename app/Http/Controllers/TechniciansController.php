<?php

namespace App\Http\Controllers;

use App\Depot;
use App\DepotUser;
use App\Technician;
use Illuminate\Http\Request;

class TechniciansController extends Controller {
	//user depot list
	private function userDepots() {
		return DepotUser::where('user_id', auth()->user()->id)->pluck('depot_id');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$technicians = Technician::with(['depot' => function ($q) {
			return $q->select('name', 'id');
		}])
			->whereIn('depot_id', $this->userDepots())
			->get();
		return view('technicians.index', compact('technicians'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$depots = Depot::whereIn('id', $this->userDepots())->pluck('name', 'id');
		return view('technicians.create', compact('depots'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$validate_data = $request->validate([
			'name' => 'required',
			'depot_id' => 'required',
			'mobile' => 'required|digits:11|unique:technicians',
			'status' => 'required',
		]);

		$technicians = Technician::create($validate_data);
		if ($technicians) {
			$message = "You have successfully created";
			return redirect()->route('technicians.index', [])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('technicians.index', [])
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
		$technicians = Technician::findOrFail($id);
		$depots = Depot::whereIn('id', $this->userDepots())->pluck('name', 'id');
		return view('technicians.edit', compact('technicians', 'depots'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$validate_Data = $request->validate([
			'name' => 'required',
			'depot_id' => 'required',
			'mobile' => 'required|digits:11|unique:technicians,mobile,' . $id,
			'status' => 'required',
		]);

		$technicians = Technician::where('id', $id)->update($validate_Data);
		if ($technicians) {
			$message = "You have successfully created";
			return redirect()->route('technicians.index', [])
				->with('flash_success', $message);
		} else {
			$message = "Nothing updated!! Please try again";
			return redirect()->route('technicians.index', [])
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
		$msg = $this->checkUses($id, 'technician_id', 'DfProblem');
		if ($msg != 'no') {
			return $msg;
		}
		$technicians = Technician::destroy($id);
		if ($technicians) {
			$message = "You have successfully deleted";
			return redirect()->route('technicians.index', [])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('technicians.index', [])
				->with('flash_danger', $message);
		}
	}

}
