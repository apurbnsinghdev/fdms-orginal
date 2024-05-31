<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Sms;
use Illuminate\Http\Request;

class SmsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$sms = Sms::exclude(['message', 'is_designation_wise', 'action'])->get();
		$designations = Designation::pluck('short_name', 'id');
		return view('sms.index', compact('sms', 'designations'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, $id) {
		$sms = Sms::findOrFail($id);
		if ($request->isMethod('put')) {
			$data = $request->all();
			$request->validate([
				'status' => 'required',
			]);
			$saveData['status'] = $data['status'];
			if (!empty($data['designations'])) {
				$saveData['designations'] = json_encode($data['designations']);
			} else {
				$saveData['designations'] = null;
			}
			$smsUpdate = $sms->update($saveData);
			if ($smsUpdate) {
				$message = "You have successfully updated";
				return redirect()->route('sms.index', [])
					->with('flash_success', $message);
			} else {
				$message = "Nothing changed!! Please try again";
				return redirect()->route('sms.index', [])
					->with('flash_warning', $message);
			}
		}

		$designations = Designation::select(\DB::raw("CONCAT(title,'(',short_name,')') AS title"), 'id')->pluck('title', 'id');
		return view('sms.edit', compact('sms', 'designations'));
	}
}
