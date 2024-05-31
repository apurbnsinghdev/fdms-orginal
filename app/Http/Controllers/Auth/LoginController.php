<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Login Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles authenticating users for the application and
		    | redirecting them to your home screen. The controller uses a trait
		    | to conveniently provide its functionality to your applications.
		    |
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct(); //for load logo
		$this->middleware('guest')->except('logout');
	}

	protected function credentials(Request $request) {
		return array_merge($request->only($this->username(), 'password'), ['status' => 'active']);
	}

	protected function sendFailedLoginResponse(Request $request) {
		$errors = [$this->username() => trans('auth.failed')];

		// Load user from database
		$user = User::where($this->username(), $request->{$this->username()})->first();

		// Check if user was successfully loaded, that the password matches
		// and active is not 1. If so, override the default error message.
		if ($user && \Hash::check($request->password, $user->password) && $user->status != 'active') {
			$errors = [$this->username() => trans('auth.notactivated')];
		}

		if ($request->expectsJson()) {
			return response()->json($errors, 422);
		}
		return redirect()->back()
			->withInput($request->only($this->username(), 'remember'))
			->withErrors($errors);
	}

}
