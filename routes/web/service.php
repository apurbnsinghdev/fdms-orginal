<?php
/*====================Ajax part start==============*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('get-items-for-service', 'AjaxController@getItemsForService')->name('ajax.items.serviceIndex');
    Route::get('get-items-for-service-history', 'AjaxController@getItemsForServiceHistory')->name('ajax.items.serviceHistory');
    //problem entry form open with item detils
    Route::get('get-item-details', 'AjaxController@getItemDetailsBySeraial')->name('ajax.items.getItemDetailsBySeraial');
    Route::get('get-problem-entries/{param}', 'AjaxController@getProblemEntries')->name('ajax.problemEntries.get');
    Route::get('get-problem-details/{param}', 'AjaxController@getProblemDetails')->name('ajax.problemDetails.get');
    Route::get('get-application-details/{param}', 'AjaxController@getApplicationDetails')->name('ajax.applicationDetails.get');
    Route::post('save-application-stage-action', 'AjaxController@saveApplicationStageAction')->name('ajax.applicationStageAction.post');
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::group(['middleware' => ['auth', 'auth.access']], function () {
    Route::resource('problem_types', 'ProblemTypesController',
        ['except' => ['show']]);
    Route::resource('technicians', 'TechniciansController',
        ['except' => ['show']]);
    Route::match(array('GET', 'POST'), 'df/problem-entry', [
        'as' => 'services.problemEntry',
        'uses' => 'ServicesController@problemEntry',
    ]);
    Route::match(array('GET', 'PUT', 'PATCH'), 'df/problem-entry/{id}/edit', [
        'as' => 'services.problemEntryEdit',
        'uses' => 'ServicesController@problemEntryEdit',
    ]);

    Route::get('df/problem-entries/{param}', [
        'as' => 'services.problemEntryList',
        'uses' => 'ServicesController@problemEntryList',
    ]);
    Route::match(array('GET', 'POST'), 'df-problem/assign-technician/{param}', [
        'as' => 'services.assignTechnician',
        'uses' => 'ServicesController@assignTechnician',
    ]);
    Route::delete('df-problem/problem-reject/{param}', [
        'as' => 'services.problemReject',
        'uses' => 'ServicesController@problemReject',
    ]);
    Route::get('df-problem/generate-claim-copy/{param}', [
        'as' => 'services.generateClaimCopy',
        'uses' => 'ServicesController@generateClaimCopy',
    ]);
    Route::match(array('GET', 'POST'), 'df/dmage/apply', [
        'as' => 'services.applyForDamage',
        'uses' => 'ServicesController@applyForDamage',
    ]);
    Route::get('damage-applications/lists/{param?}', [
        'as' => 'services.damageApplicationList',
        'uses' => 'ServicesController@damageApplicationList',
    ]);

    Route::get('service-history/{param?}', [
        'as' => 'services.history',
        'uses' => 'ServicesController@history',
    ]);
});
/*====================Permission part end==============*/

?>