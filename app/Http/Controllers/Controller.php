<?php

namespace App\Http\Controllers;

use App\RolePermission;
use App\SiteSetting;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $menu_list, $site_settings;

	public function __construct() {
		$this->middleware(function ($request, $next) {

			$switch = false;
			if ($request->user()) {
				$rolePermissions = RolePermission::select('permission_id')
					->with(['permission' => function ($q) {
						$q->select('id', 'name', 'parent_id');
					}])
					->where('role_id', $request->user()->role_id)
					->get()
					->toArray();

				$controllerArr = [];
				$allIndexes = [];
				foreach ($rolePermissions as $key => $value) {
					if ($value['permission']['parent_id'] == null) {
						$controllerArr[$value['permission']['id']] = $value['permission']['name'];
					} else {
						$allIndexes[] = $controllerArr[$value['permission']['parent_id']] . '@' . $value['permission']['name'];
					}
				}

				$this->menu_list = $allIndexes;

				view()->share('controller_list', $controllerArr);
				view()->share('menu_list', $allIndexes);

				if (auth()->user()->common_username) {
					$switch = User::join('users as con', 'con.common_username', '=', 'users.common_username')
						->where('users.common_username', auth()->user()->common_username)
						->where('users.id', '<>', 'con.id')
						->where('con.status', 'active')
						->exists();
				}
				view()->share('is_switch', $switch);
			}

			$this->site_settings = SiteSetting::first();
			view()->share('site_settings', $this->site_settings);

			return $next($request);
		});
	}

	public function checkUses($id, $fieldName, $usesModel) {
		$message = 'This data is already used by another.';
		if (is_array($usesModel)) {
			foreach ($usesModel as $val) {
				$namespace = 'App\\' . $val;
				if ($namespace::where($fieldName, $id)->exists()) {
					return redirect()->back()->with('flash_danger', $message);
				}
			}
			return 'no';
		} else {
			$namespace = 'App\\' . $usesModel;
			if ($namespace::where($fieldName, $id)->exists()) {
				return redirect()->back()->with('flash_danger', $message);
			} else {
				return 'no';
			}
		}

	}

}
