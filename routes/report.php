<?php

Route::group(['prefix' => 'report', 'middleware' => ['auth']], function () {

    Route::any('inventory/{param?}', 'Report\InventoryReportsController@index')->name('inventoryreports.index');

    Route::any('depot-df-status', 'Report\InventoryReportsController@getDepotDFStatus')->name('inventoryreports.getDepotDFStatus');

    Route::any('size-wise-df-status/{param?}', 'Report\InventoryReportsController@getSizeWiseDFStatus')->name('inventoryreports.getSizeWiseDFStatus');

    Route::any('size-wise-distributor-df-status/{param?}', 'Report\InventoryReportsController@getSizeWiseDistributorDFStatus')->name('inventoryreports.getSizeWiseDistributorDFStatus');

    Route::any('brand-wise-df-status/{param?}', 'Report\InventoryReportsController@getBrandWiseDFStatus')->name('inventoryreports.getBrandWiseDFStatus');

    Route::any('migration/{year}', 'Report\InventoryReportsController@migration')->name('inventoryreports.migration');

    //Service Module Start

    Route::any('service', 'Report\ServiceReportsController@index')->name('servicereports.index');

    Route::any('df-wise-complain/{param?}', 'Report\ServiceReportsController@dfWiseComplain')->name('servicereports.dfWiseComplain');

    Route::any('size-wise-complain/{param?}', 'Report\ServiceReportsController@sizeWiseComplain')->name('servicereports.sizeWiseComplain');

    Route::any('type-wise-complain/{param?}', 'Report\ServiceReportsController@typeWiseComplain')->name('servicereports.typeWiseComplain');

    Route::any('date-wise-complain/{param?}', 'Report\ServiceReportsController@dateWiseComplain')->name('servicereports.dateWiseComplain');

    Route::any('long-pending-complain', 'Report\ServiceReportsController@longPendingComplain')->name('servicereports.longPendingComplain');

    Route::any('job-card-complain', 'Report\ServiceReportsController@jobCardComplain')->name('servicereports.jobCardComplain');

    Route::any('damaged-report-lists', 'Report\ServiceReportsController@damagedLists')->name('servicereports.damagedLists');

});
