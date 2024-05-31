<?php

return [
	'status' => [
		'active' => 'Active',
		'inactive' => 'Inactive',
	],
	'availability' => [
		'yes' => 'Yes',
		'no' => 'No',
	],
	'menu' => [
		'configaration' => ['SiteSettingsController', 'LocationsController', 'ZonesController', 'BrandsController', 'SizesController', 'DepotsController', 'DesignationsController', 'DamageTypesController', 'StagingsController', 'DistributorsController'],
		'user' => ['RolesController', 'RegisterController', 'ImpersonatesController'],
		'sms_promotionals' => ['SmsPromotionalsController'],
		'inventory' => ['SuppliersController', 'InventoriesControler'],
		'requisition' => ['ShopsController', 'RequisitionsController'],
		'service' => ['ProblemTypesController', 'TechniciansController', 'ServicesController'],
		'return' => ['DfReturnsController'],
		'report' => ['InventoryReportsController', 'ServiceReportsController'],
		'settlement' => ['SettlementsController'],
	],
	'payment_modes' => [
		'without_rent' => 'Without Rent',
		'concession' => 'Concession',
		'full_paid' => 'Full Paid',
	],
	'shop_category' => [
		'a' => 'A',
		'b' => 'B',
		'c' => 'C',
		'd' => 'D',
	],
	'freeze_service_status' => [
	],
	'application_type' => [
		'requisition' => 'Requisition',
		'return' => 'Return',
		'transfer' => 'Transfer',
		'service' => 'Service',
	],
	'application_status' => [
		'draft' => 'Draft',
		'new' => 'New',
		'pending' => 'Pending',
		'on_hold' => 'On Hold',
		'processing' => 'Processing',
		'approved' => 'Approved',
		'completed' => 'Completed',
		'cancelled' => 'Cancelled',
	],
	'freeze_status' => [
		'fresh' => 'Fresh',
		'beta' => 'Beta',
		'old' => 'Old',
		'damage' => 'Damage',
		'disposed' => 'Disposed',
	],
	'boolArr' => [
		'0' => 'No',
		'1' => 'Yes',
	],
	'staging' => [
		'requisition' => [
			'hold',
			'approve',
			'cancel',
			'validate',
		],
		'return' => [
			'hold',
			'approve',
			'cancel',
		],
		'damage_application' => [
			'hold',
			'approve',
		],
	],
	'payment_methods' => [
		'bkash' => 'bKash',
		'bank' => 'Bank',
		'cash' => 'Cash',
	],
	'requisition_file' => [
		'money_receipt',
		'deed_paper',
	],
	'shop_file' => [
		'proprietor_picture',
		'trade_license_copy',
		'nid_copy',
	],
	'other_company_df' => [
		'Igloo' => 'Igloo',
		'Lovello' => 'Lovello',
		'Bellissimo' => 'Bellissimo',
		'Kwality' => 'Kwality',
		'Bloop' => 'Bloop',
		'Savoy' => 'Savoy',
		'Others' => 'Others',
	],
	'promotional_sms_group' => [
		'sales_team' => 'sales_team',
		'distributors' => 'distributors',
		'outlets' => 'outlets',
	],
]
?>