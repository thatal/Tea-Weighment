<?php

use Illuminate\Http\Request;

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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'vendor'], function () {
    Route::post('login', [
        "uses"  => "Mobile\Vendor\AuthController@login"
    ]);
    Route::group(['middleware' => [/* 'auth:sanctum' */]], function () {
        Route::get('available-factory-fetch', [
            "uses"  => "Mobile\Vendor\DashboardController@factoryFetch"
        ]);
        Route::get('available-vehicle-type-fetch', [
            "uses"  => "Mobile\Vendor\DashboardController@vehicleFetch"
        ]);
        Route::get('vendors-offer-today', [
            "uses"  => "Mobile\Vendor\DashboardController@fetchVendorTodayOffers"
        ]);
        Route::get('vendors-offer-all', [
            "uses"  => "Mobile\Vendor\DashboardController@fetchVendorOffers"
        ]);
        Route::post('offer-create', [
            "uses"  => "Mobile\Vendor\DashboardController@offerCreate"
        ]);
        Route::post('offer-reject/{vendorOffer}', [
            "uses"  => "Mobile\Vendor\DashboardController@rejectOffer"
        ]);
        Route::post('offer-accept/{vendorOffer}', [
            "uses"  => "Mobile\Vendor\DashboardController@acceptOffer"
        ]);
    });
});
Route::group(['prefix' => 'factory'], function () {
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('offer-fetch', [
            "uses"  => "Mobile\Factory\OfferController@confirmationFetch"
        ]);
        Route::post('offer-first-weight', [
            "uses"  => "Mobile\Factory\OfferController@firstWeightDataSave"
        ]);
        Route::post('offer-second-weight', [
            "uses"  => "Mobile\Factory\OfferController@secondWeightDataSave"
        ]);
        Route::get('vendors-offer-all', [
            "uses"  => "Mobile\Factory\OfferController@index"
        ]);
    });
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(["prefix" => "admin"], function(){
    Route::post('/login', [
        "uses"  => "Api\Admin\AuthController@login"
    ]);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', [
            "uses"  => "Api\Admin\AuthController@logout"
        ]);

        // Vehicle routes here
        Route::resource('vehicle', 'Api\VehicleController');
    });
});
