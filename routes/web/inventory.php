<?php
/*====================Ajax part start==============*/
Route::group(['middleware' => 'auth'], function () {
	Route::get('get-stocks', 'AjaxController@getStocks')->name('ajax.stocks.get');
	Route::get('get-stock-details/{param}', 'AjaxController@getStockDetails')->name('ajax.stocks.details');
	Route::get('get-allocation-details/{param}', 'AjaxController@getAllocationDetails')->name('ajax.allocation.details');
	Route::get('allocation-receive/{param}', 'AjaxController@depotStockAccept')->name('ajax.allocation.receive');
	Route::get('get-allocations', 'AjaxController@getAllocations')->name('ajax.allocation.index');
	Route::get('get-depot-allocations/{stockId?}', 'AjaxController@getDepotAllocations')->name('ajax.depotAllocation.index');
	Route::get('get-items/{param}', 'AjaxController@getItems')->name('ajax.items.index');

	Route::get("stock-transfer-show/{stock_transfer_id}", array(
		'uses' => 'AjaxController@stockTransferShow',
		'as' => 'inventories.stockTransferShow',
	));

	Route::get("stock-transfer-edit/{from_depot}/{transfer_id}", array(
		'uses' => 'AjaxController@stockTransferEdit',
		'as' => 'inventories.stockTransferEdit',
	));
	Route::get("get-df-code-lists", array(
		'uses' => 'AjaxController@dfcodeLists',
		'as' => 'ajax.inventories.dfcodeLists',
	));
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::group(['middleware' => ['auth', 'auth.access']], function () {
	Route::resource('suppliers', 'SuppliersController',
		['except' => ['show']]);

	Route::match(array('GET', 'POST'), "stocks/create", array(
		'uses' => 'InventoriesControler@stockCreate',
		'as' => 'inventories.stockCreate',
	));
	Route::get("stock-index/{param?}", array(
		'uses' => 'InventoriesControler@stockIndex',
		'as' => 'inventories.stockIndex',
	));
	Route::match(array('GET', 'PUT', 'PATCH'), "stocks/{stocks}/edit", array(
		'uses' => 'InventoriesControler@stockEdit',
		'as' => 'inventories.stockEdit',
	));
	Route::delete("stocks/{stocks}", array(
		'uses' => 'InventoriesControler@stockDestroy',
		'as' => 'inventories.stockDestroy',
	));
	Route::match(array('GET', 'POST'), "stocks/{stocks}/stock-allocate", array(
		'uses' => 'InventoriesControler@stockAllocate',
		'as' => 'inventories.stockAllocate',
	));
	Route::get("allocations", array(
		'uses' => 'InventoriesControler@allocatedStockIndex',
		'as' => 'inventories.allocatedStockIndex',
	));

	Route::match(array('GET', 'PUT', 'PATCH'), "allocations/{stocks}/edit", array(
		'uses' => 'InventoriesControler@allocatedStockEdit',
		'as' => 'inventories.allocatedStockEdit',
	));

	Route::delete("allocations/{stocks}", array(
		'uses' => 'InventoriesControler@allocatedStockDelete',
		'as' => 'inventories.allocatedStockDelete',
	));

	Route::get("depot/allocations/{stocks?}", array(
		'uses' => 'InventoriesControler@depotAllocatedStockIndex',
		'as' => 'inventories.depotAllocatedStockIndex',
	));
	Route::get("allocation/{stocks}/print", array(
		'uses' => 'InventoriesControler@allocationPrint',
		'as' => 'inventories.allocationPrint',
	));
	Route::post("allocation/{stock}/approve", array(
		'uses' => 'InventoriesControler@allocationApprove',
		'as' => 'inventories.allocationApprove',
	));
	Route::match(array('GET', 'POST'), "items/create", array(
		'uses' => 'InventoriesControler@allocatedStockReceive',
		'as' => 'inventories.allocatedStockReceive',
	));
	Route::post("items/input-item-serial", array(
		'uses' => 'InventoriesControler@inputItemSerial',
		'as' => 'inventories.inputItemSerial',
	));
	Route::get("items/{param?}", array(
		'uses' => 'InventoriesControler@itemIndex',
		'as' => 'inventories.itemIndex',
	));
	Route::post("items/return-support-df", array(
		'uses' => 'InventoriesControler@returnSupportDf',
		'as' => 'inventories.returnSupportDf',
	));
	Route::post("item/change-status", array(
		'uses' => 'InventoriesControler@changeItemStatus',
		'as' => 'inventories.changeItemStatus',
	));
	Route::get("item/item-export/{param}", array(
		'uses' => 'InventoriesControler@itemExport',
		'as' => 'inventories.itemExport',
	));
	Route::match(['GET', 'POST'], "stock-transfer/create/{depot?}", array(
		'uses' => 'InventoriesControler@stockTransferCreate',
		'as' => 'inventories.stockTransferCreate',
	));

	Route::get("stock-transfer-lists", array(
		'uses' => 'InventoriesControler@stockTransferLists',
		'as' => 'inventories.stockTransferLists',
	));

	Route::post("stock-transfer-receive", array(
		'uses' => 'InventoriesControler@stockTransferReceive',
		'as' => 'inventories.stockTransferReceive',
	));

	Route::post("stock-transfer-update", array(
		'uses' => 'InventoriesControler@stockTransferUpdate',
		'as' => 'inventories.stockTransferUpdate',
	));

	Route::match(array('GET', 'POST'), "stock-transfer-approve/{transfer_id}", array(
		'uses' => 'InventoriesControler@stockTransferApprove',
		'as' => 'inventories.stockTransferApprove',
	));

	Route::post("stock-transfer-cancel", array(
		'uses' => 'InventoriesControler@stockTransferCancel',
		'as' => 'inventories.stockTransferCancel',
	));

	Route::get("stock-transfer-chanal/{transfer_id}", array(
		'uses' => 'InventoriesControler@StockTransferChalan',
		'as' => 'inventories.getStockTransferChalan',
	));

	Route::match(['POST', 'GET'], 'generate/df-code', [
		'uses' => 'InventoriesControler@generateDFCode',
		'as' => 'inventories.generateDFCode',
	]);
	Route::match('POST', 'download/df-code', [
		'uses' => 'InventoriesControler@downloadDFCode',
		'as' => 'inventories.downloadDFCode',
	]);

});
/*====================Permission part end==============*/

?>