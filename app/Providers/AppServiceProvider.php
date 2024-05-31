<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use DB;
use Event;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		include __DIR__ . '/../Http/Macros.php';

		// current password validation rule
		Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
			return Hash::check($value, Auth::user()->password);
		});

	    if (env('APP_ENV') === 'local') {
	        DB::connection()->enableQueryLog();        
	    }
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
