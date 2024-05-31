<?php
/*====================Ajax part start==============*/
Route::group(['middleware' => 'auth'], function () {
	Route::get('get-shops/{param?}', 'AjaxController@getShopsWithPaginate')->name('ajax.shops.get');
	Route::get('get-shop-details/{param}', 'AjaxController@getShopDetails')->name('ajax.shops.details');
	Route::get('get-shop-compare-details/{returnId}', 'AjaxController@getShopCompareDetails')->name('ajax.shops.details');
	Route::get('get-distributor', 'AjaxController@getDistributorsWithPaginate')->name('ajax.distributors.get');
	Route::get('get-distributor-details/{param}', 'AjaxController@getDistributorDetails')->name('ajax.distributor.details');
	Route::get('get-requisition-details/{param}', 'AjaxController@getRequisitionDetails')->name('ajax.requisition.details');
	// Route::get('check-requisition-status', 'AjaxController@checkRequisitionStatus')->name('ajax.checkRequisitionStatus');
	Route::get('get-transaction-id', 'AjaxController@getTransactionId')->name('ajax.getTransactionId');
	Route::any('put-transaction-id', 'AjaxController@putTransactionId')->name('ajax.putTransactionId');
	Route::get('user-depot-shops', 'AjaxController@getShops')->name('ajax.getShops');
	Route::post('get-depot-distributor', 'AjaxController@getDepotDistributor')->name('ajax.shops.getDepotDistributor');
	//Route::get('get-depot-item-brand', 'AjaxController@getDepotItemBrand')->name('ajax.shops.getDepotItemBrand');
	Route::get('get-return-df-sizes', 'AjaxController@getReturnDFSizes')->name('ajax.getReturnDFSizes');
	Route::get('check-available-stock', 'AjaxController@checkStock')->name('ajax.checkStock');
	Route::get('get-current-dfs', 'AjaxController@getCurrentDfs')->name('ajax.getCurrentDfs');
	Route::get('get-return-df', 'AjaxController@getReturnDF')->name('ajax.getReturnDF');
	Route::get('get-all-documents', 'AjaxController@getAllDocuments')->name('ajax.getAllDocuments');
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::group(['middleware' => ['auth', 'auth.access']], function () {
	//=====shops start here=======
	Route::get('shops/index/{param?}', [
		'as' => 'shops.index',
		'uses' => 'ShopsController@index',
	]);

	Route::match(array('PUT', 'PATCH'), 'distributor-shop-transfer/{id}', [
		'as' => 'distributor.shops.transfer',
		'uses' => 'ShopsController@distributorShopTransfer',
	]);
	Route::resource('shops', 'ShopsController',
		['except' => ['index', 'show']]);

	Route::match(array('POST'),'shops/download/{param?}', [
		'as' => 'shops.download',
		'uses' => 'ShopsController@download',
	]);

	//====shops end here=====

	Route::get('requisitions/create/{param?}', [
		'as' => 'requisitions.create',
		'uses' => 'RequisitionsController@create',
	]);

	Route::get('requisitions/index/{param?}', [
		'as' => 'requisitions.index',
		'uses' => 'RequisitionsController@index',
	]);

	Route::any('requisitions/payment/verify/{param}', [
		'as' => 'requisitions.payment_verify',
		'uses' => 'RequisitionsController@payment_verify',
	]);

	Route::any('requisitions/bkash/verify/{param}', [
		'as' => 'requisitions.bkash_verify',
		'uses' => 'RequisitionsController@bkash_verify',
	]);

	Route::any('requisitions/document/verify/{param}', [
		'as' => 'requisitions.document_verify',
		'uses' => 'RequisitionsController@document_verify',
	]);

	Route::any('requisitions/freeze/assign/{param}', [
		'as' => 'requisitions.freeze_assign',
		'uses' => 'RequisitionsController@freeze_assign',
	]);

	Route::any('requisitions/generate/gatepass/{param}', [
		'as' => 'requisitions.generate_gatepass',
		'uses' => 'RequisitionsController@generate_gatepass',
	]);
	Route::match(['GET', 'PUT', 'PATCH'], 'requisitions/{id}/resend', [
		'as' => 'requisitions.resend',
		'uses' => 'RequisitionsController@resend',
	]);
	Route::any('requisitions/deed-paper/{param}', [
		'as' => 'requisitions.deedPapergenerate',
		'uses' => 'RequisitionsController@deedPaperGenerate',
	]);
	Route::match(['POST'], 'requisitions/approve-all', [
		'as' => 'requisitions.approveAll',
		'uses' => 'RequisitionsController@approveAll',
	]);
	Route::resource('requisitions', 'RequisitionsController',
		['except' => ['index', 'create']]);
});
/*====================Permission part end==============*/
?>