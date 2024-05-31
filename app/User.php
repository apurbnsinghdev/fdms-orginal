<?php

namespace App;
use App\DepotUser;
use App\DistributorUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'role_id', 'designation_id', 'email', 'mobile', 'password', 'status', 'avatar',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function role() {
		return $this->belongsTo(Role::class);
	}

	public function designation() {
		return $this->belongsTo(Designation::class);
	}

	public function deg() {
		return $this->belongsTo(Designation::class);
	}

	public function depots() {
		return $this->hasMany(DepotUser::class);
	}

	public static function boot() {
		parent::boot();
		self::saved(function ($model) {
			if (request()->get('depots')) {
				$userId = $model->id;

				if (count(request()->get('depots')) > 0) {
					$arr = [];
					$DepotUser = new DepotUser();
					$DepotUser->where('user_id', $userId)->delete();
					foreach (request()->get('depots') as $key => $value) {
						$arr[$key]['user_id'] = $userId;
						$arr[$key]['depot_id'] = $value;
					}
					$DepotUser->insert($arr);
				}

				if (request()->get('distributors')) {
					$arr2 = [];
					$DistributorUser = new DistributorUser();
					$DistributorUser->where('user_id', $userId)->delete();
					foreach (request()->get('distributors') as $key => $value) {
						$arr2[$key]['user_id'] = $userId;
						$arr2[$key]['distributor_id'] = $value;
					}
					$DistributorUser->insert($arr2);
				}
			}
		});

	}
}
