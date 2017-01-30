<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// unguarded routes
Route::group(['prefix' => 'v1'], function () {
    Route::post('authenticate/authenticate', 'AuthenticateController@authenticate');
});

// jwt.auth guarded routes
Route::group(['prefix' => 'v1', 'middleware' => 'jwt.auth'], function () {
    // authenticate
    Route::get('authenticate/authenticated', 'AuthenticateController@getAuthenticatedUser');
    // grouped access to the certain user's dependent resources
    Route::group([
        'prefix' => 'users/{user}',
        'middleware' => 'can:access,user'
    ], function () {
        Route::resource('electricity-charges', 'ElectricityChargeController', [
            'except' => ['create', 'edit'],
            'parameters' => ['electricity-charges' => 'electricityCharge']
        ]);
        Route::post('electricity-readings/restore', 'ElectricityReadingController@restore');
        Route::get('electricity-readings/dump', 'ElectricityReadingController@dump');
        Route::resource('electricity-readings', 'ElectricityReadingController', [
            'except' => ['create', 'edit'],
            'parameters' => ['electricity-readings' => 'electricityReading']
        ]);
        Route::post('gas-invoices/restore', 'GasInvoiceController@restore');
        Route::get('gas-invoices/dump', 'GasInvoiceController@dump');
        Route::get('gas-invoices/aggregates', 'GasInvoiceController@aggregates');
        Route::resource('gas-invoices', 'GasInvoiceController', [
            'except' => ['create', 'edit'],
            'parameters' => ['gas-invoices' => 'gasInvoice']
        ]);
        Route::post('gas-readings/restore', 'GasReadingController@restore');
        Route::get('gas-readings/dump', 'GasReadingController@dump');
        Route::resource('gas-readings', 'GasReadingController', [
            'except' => ['create', 'edit'],
            'parameters' => ['gas-readings' => 'gasReading']
        ]);
        Route::post('water-readings/restore', 'WaterReadingController@restore');
        Route::get('water-readings/dump', 'WaterReadingController@dump');
        Route::resource('water-readings', 'WaterReadingController', [
            'except' => ['create', 'edit'],
            'parameters' => ['water-readings' => 'waterReading']
        ]);
    });
});