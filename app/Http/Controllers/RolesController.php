<?php

namespace App\Http\Controllers;
use App\Permission;
use App\Role;
use App\RolePermission;
use App\User;
use Illuminate\Http\Request;
use Redirect;
use Route;

class RolesController extends Controller {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$roles = Role::orderBy('is_deletable', 'desc')->get();
		$roleArr = Role::pluck('name', 'id');
		//dd($roles);
		return View('roles.index', compact('roles', 'roleArr'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		/*create permission*/
		$this->createRolePermission();
		$permission = array();
		$parents = Permission::where('parent_id', NULL)->orderBy('name')->pluck('name', 'id')->toArray();
		$childs = Permission::whereIn('parent_id', array_keys($parents))->get(array('name', 'id', 'parent_id'));

		if (count($parents)) {
			foreach ($childs as $ele) {
				$arrr[$ele->parent_id][$ele->id] = $ele->name;
			}
			foreach ($parents as $key => $parent) {
				foreach ($arrr[$key] as $key2 => $child) {
					$permission[$parent][$key2] = $child;
				}
			}
		}

		return View('roles.create', compact('permission', 'parents'))->render();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request) {

		$data = $request->only('name', 'description', 'status', 'is_deletable', 'can_apply');
		$data_all = $request->except('name', 'description', 'status', 'is_deletable', 'can_apply', '_token');
		$request->validate([
			'name' => 'required|unique:roles',
			'description' => 'required|string|max:255',
		]);

		$roles = Role::create($data);
		if ($roles) {
			$all_done = false;
			if (count($data_all)) {
				$data2['role_id'] = $roles->id;
				foreach ($data_all as $data_one) {
					$data2['permission_id'] = $data_one;
					$all_done = RolePermission::create($data2);
				}
			}
			if ($all_done) {
				$message = "You have successfully created";
				return redirect()->route('roles.index')
					->with('flash_success', $message);
			} else {
				$message = "You have successfully created role but no permission set";
				return redirect()->route('roles.index')
					->with('flash_warning', $message);
			}
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$roles = Role::findorfail($id);
		$permissions = Permission::with('children')->whereNull('parent_id')->orderBy('name')->get()->toArray();
		$checkPermissions = RolePermission::with('Permission')->where('role_id', $id)->pluck('permission_id')->toArray();
		return View('roles.edit', compact('permissions', 'checkPermissions', 'roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$data = $request->only('name', 'description', 'status', 'is_deletable', 'can_apply');
		$request->validate([
			'name' => 'required|unique:roles,name,' . $id,
			'description' => 'required|string|max:255',
		]);

		if (!isset($data['can_apply'])) {
			$data['can_apply'] = 0;
		}

		$permissions = request()->get('permissions');
		if (!isset($permissions)) {$permissions = array();}
		$Role = Role::find($id);
		$Role->fill($data);
		$Role->save();
		$Role->permissions()->sync($permissions);
		if ($Role) {
			$message = "You have successfully updated";
			return redirect()->route('roles.edit', $id)
				->with('flash_success', $message);

		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id) {
		$data = $request->only('role_id');
		$applyed = User::where('role_id', $id)->update($data);
		$permissionDelete = RolePermission::where('role_id', $id)->delete();
		$Role = Role::destroy($id);
		if ($Role) {
			$message = "You have successfully deleted";
			return redirect()->route('roles.index')
				->with('flash_success', $message);
		}

	}

	private function createRolePermission() {
		$omitArrLists = [
			'AjaxController',
			'ForgotPasswordController',
			'ResetPasswordController',
			'HomeController',
			'LoginController',
		];
		$omitActionsArrList = [
			'ImpersonatesController@SwitchBackToAdmin',
			'ImpersonatesController@SwitchBetweenUserToUser',
		];
		$allRoutes = Route::getRoutes();
		//dd($allRoutes);
		$controllers = array();
		foreach ($allRoutes as $route) {
			$action = $route->getAction();
			if (array_key_exists('controller', $action)) {
				$controllerWithActions = class_basename($action['controller']);
				// permission not need for this omitActionsArrList actions
				if (!in_array($controllerWithActions, $omitActionsArrList)) {
					list($Controller, $Action) = explode('@', $controllerWithActions);
					$controllers[$Controller][$Action] = $Action;
				}
			}
		}

		// permission not need for this following controlles
		$controllers = array_diff_key($controllers, array_combine($omitArrLists, $omitArrLists));

		foreach ($controllers as $key => $actionArr) {
			$data['name'] = $key;
			$parent = Permission::firstOrCreate($data);
			if ($parent) {
				$data2['parent_id'] = $parent->id;
				foreach ($actionArr as $action) {
					$data2['name'] = $action;
					$all_done = Permission::firstOrCreate($data2);
				}
			}
		}
	}

}
