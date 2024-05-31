<?php
/*====================Ajax part start==============*/
Route::group(['middleware' => 'auth'], function () {
	Route::get("distributor/{distributor_id}/shops/{from_shop_id}", array(
		'uses' => 'AjaxController@getDistributorShops',
		'as' => 'ajax.getDistributorShops',
	));
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::group(['middleware' => ['auth', 'auth.access']], function () {
	Route::match(array('GET', 'POST'), "returns/apply", array(
		'uses' => 'DfReturnsController@apply',
		'as' => 'returns.apply',
	));
	Route::get("returns/index/{param?}", array(
		'uses' => 'DfReturnsController@index',
		'as' => 'returns.index',
	));
});
/*====================Permission part end==============*/

?>