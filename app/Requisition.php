<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model {
	//public $timestamps = false;
	protected $guarded = array('id');

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function creator() {
		return $this->belongsTo(User::class, 'created_by');
	}

	public function stager() {
		return $this->belongsTo(User::class, 'action_by');
	}

	public function payment_verifier() {
		return $this->belongsTo(User::class, 'payment_verrified_by');
	}

	public function document_verifier() {
		return $this->belongsTo(User::class, 'doc_verified_by');
	}

	public function size() {
		return $this->belongsTo(Size::class);
	}

	public function shop() {
		return $this->belongsTo(Shop::class);
	}

	public function distributor() {
		return $this->belongsTo(Shop::class, 'distributor_id');
	}

	public function currentdf() {
		return $this->belongsTo(Item::class, 'current_df');
	}

	public function item() {
		return $this->belongsTo(Item::class);
	}

	public function documents() {
		return $this->hasMany(Document::class, 'data_id')->where('module', 'requisition');
	}

	public function depot() {
		return $this->belongsTo(Depot::class);
	}

	public function comments() {
		return $this->hasMany(RequisitionLog::class);
	}

	public function bkashes() {
		return $this->hasMany(Bkash::class);
	}

	public function physical_visits() {
		return $this->hasMany(PhysicalVisit::class);
	}

	public function scopeRequisitionApprovalSmsData($query, $id) {
		return $query->join('shops', 'shops.id', '=', 'requisitions.shop_id')
			->join('users', 'users.id', '=', 'requisitions.user_id')
			->select(
				'shops.proprietor_name',
				'shops.outlet_name',
				'shops.mobile',
				'requisitions.distributor_id',
				'requisitions.reference_id as token',
				'users.name as sender',
				'users.mobile as sender_mobile'
			)
			->findOrFail($id);
	}

	public function validator() {
		return $this->belongsTo(User::class, 'validate_by');
	}

}
