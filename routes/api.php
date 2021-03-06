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
// url for vendor app
Route::group(['prefix' => 'vendor'], function () {
    Route::post('login', [
        "uses"  => "Mobile\Vendor\AuthController@login"
    ]);
    Route::post('register', [
        "uses"  => "Mobile\Vendor\AuthController@register"
    ]);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('available-factory-fetch', [
            "uses"  => "Mobile\Vendor\DashboardController@factoryFetch"
        ]);
        Route::get('daily-slab-fetch', [
            "uses"  => "Mobile\Vendor\DashboardController@factorySlabFetch"
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
        Route::post('offer-reject', [
            "uses"  => "Mobile\Vendor\DashboardController@rejectOffer"
        ]);
        Route::post('offer-accept', [
            "uses"  => "Mobile\Vendor\DashboardController@acceptOffer"
        ]);
        Route::post('counter-offer', [
            "uses"  => "Mobile\Vendor\DashboardController@counterOffer"
        ]);
        Route::post('change-password', [
            "uses"  => "Mobile\Vendor\AuthController@changePassword"
        ]);
    });
});
// url for factory app
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
Route::get("app-version", function(){
    return [
        "version"   => env("APP_VERSION")
    ];
});
Route::group(['prefix' => 'approver'], function () {
    Route::post('login', [
        "uses"  => "Mobile\Vendor\AuthController@login"
    ]);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('offer-fetch', [
            "uses"  => "Mobile\Provider\OfferController@index",
            "as"  => "api.approver.offer-fetch",
        ]);
        Route::get('importants-data', [
            "uses"  => "Mobile\Provider\ProviderDashController@importantApiData",
        ]);
        Route::post("offer-accept/{vendorOffer}", [
            "uses" => 'Mobile\Provider\OfferController@confirmOrder',
            "as"   => "api.approver.offer.accept",
        ]);
        Route::post("offer-cancel/{vendorOffer}", [
            "uses" => 'Mobile\Provider\OfferController@cancelOffer',
            "as"   => "api.approver.offer.cancel",
        ]);
        Route::post("counter-offer", [
            "uses" => 'Mobile\Provider\OfferController@counterOffer',
            "as"   => "api.approver.counter.offer",
        ]);
    });
});
Route::post("/token-register", [
    "uses" => "HomeController@tokenRegister",
    "as" => "token-register"
])->middleware("auth:sanctum");
