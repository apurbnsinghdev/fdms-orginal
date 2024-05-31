<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonatesController extends Controller {

	public function syncCreate(Request $request) {
		if ($request->isMethod('put')) {
			$data = $request->only('user_from', 'user_to');
			$saveData = $request->only('common_username');
			$request->validate([
				'user_from' => 'required',
				'user_to' => 'required|different:user_from',
				'common_username' => 'required|max:25|unique:users',
			]);

			User::where('id', $data['user_from'])->update($saveData);
			User::where('id', $data['user_to'])->update($saveData);

			$message = "You have successfully synced user";
			return redirect()->route('users.syncList')
				->with('flash_success', $message);
		} else {

			$users = User::select('users.id')
				->join('designations', 'designations.id', '=', 'users.designation_id')
				->selectRaw("CONCAT(users.email,' (',users.name,' :: ',users.mobile,' :: ',designations.title,')') as name")
				->whereNull('users.common_username')
				->where('users.status', 'active')
				->pluck('name', 'users.id');

			return view('impersonates.sync_create', compact('users'));
		}
	}

	public function syncList() {

		$userIds = User::selectRaw('MIN(id) as id')
			->groupBy(['common_username'])
			->whereNotNull('common_username')
			->pluck('id');

		$users = User::join('users as con', 'con.common_username', '=', 'users.common_username')
			->join('designations as userDesig', 'userDesig.id', '=', 'users.designation_id')
			->join('designations as conDesig', 'conDesig.id', '=', 'con.designation_id')
			->select('users.name', 'users.email', 'users.mobile', 'users.common_username', 'userDesig.title as designation', 'con.name as con_name', 'con.email as con_email', 'con.mobile as con_mobile', 'conDesig.title as con_designation')
			->whereIn('users.id', $userIds)
			->whereNotIn('con.id', $userIds)
			->get();
		return view('impersonates.sync_list', compact('users'));
	}

	public function unSync($common_username) {
		$query = User::where('common_username', $common_username)->update(['common_username' => NULL]);
		if ($query) {
			$message = "Successfully un-synced user";
			return redirect()->route('users.syncList')->with('flash_success', $message);
		} else {
			$message = "Something wrong. Please try again";
			return redirect()->route('users.syncList')->with('flash_danger', $message);
		}
	}

	public function SwitchBetweenUserToUser() {
		$authUser = auth()->user();
		if ($authUser->common_username) {
			$otheAccountsInfo = User::where('id', '<>', auth()->user()->id)
				->where('common_username', $authUser->common_username)
				->first();
			Auth::login($otheAccountsInfo);
			return redirect()->route('dashboard');
		} else {
			$message = "Something wrong. Please try again";
			return redirect()->back()->with('flash_danger', $message);
		}
	}

	public function SwitchAmongAllUsers(Request $request) {
		if ($request->isMethod('put')) {
			$data = $request->only('user_id');
			$request->validate([
				'user_id' => 'required',
			]);
			$request->session()->put('polar_administrattor_id', auth()->id());
			Auth::loginUsingId($data['user_id']);
			return redirect()->route('dashboard');
		} else {
			$users = User::select('users.id')
				->join('designations', 'designations.id', '=', 'users.designation_id')
				->selectRaw("CONCAT(users.email,' (',users.name,' :: ',users.mobile,' :: ',designations.title,')') as name")
				->where('users.id', '<>', auth()->id())
				->where('users.status', 'active')
				->pluck('name', 'users.id');

			return view('impersonates.switch_among_all_users', compact('users'));
		}
	}

	public function SwitchBackToAdmin(Request $request) {
		$data = $request->only('administrator_id');
		$request->validate([
			'administrator_id' => 'required',
		]);
		if ($request->session()->exists('polar_administrattor_id')) {
			$request->session()->forget('polar_administrattor_id');
		}
		Auth::loginUsingId($data['administrator_id']);
		return redirect()->route('dashboard');
	}
}
