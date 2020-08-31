<?php

// factory routes here
Route::group([
        'prefix' => 'factory',
        "as" => "factory.",
        "namespace" => "Factory",
        "middleware" => "factory"
    ], function () {

    Route::get("dashboard", [
        "uses" => 'DashboardController@dashboard',
        "as"   => "dashboard",
        "middleware"    => "factory_slab"
    ]);
    Route::get("switch-available", [
        "uses" => 'DashboardController@switchAvailable',
        "as"   => "switch-available",
        "middleware"    => "factory_slab"
    ]);
    Route::get("offer-accept/{vendorOffer}", [
        "uses" => 'DashboardController@confirmOrder',
        "as"   => "offer.accept",
        "middleware"    => "factory_slab"
    ]);
    Route::get("offer-cancel/{vendorOffer}", [
        "uses" => 'DashboardController@cancelOffer',
        "as"   => "offer.cancel",
        "middleware"    => "factory_slab"
    ]);
    Route::post("offer-incentive/{vendorOffer}", [
        "uses" => 'DashboardController@incentiveVendorOffer',
        "as"   => "offer.incentive",
        "middleware"    => "factory_slab"
    ]);
    Route::group(['prefix' => 'vendor'], function () {
        Route::get("/", [
            "uses"  => "VendorController@index",
            "as"  => "vendor.index",
        ]);
    });
    Route::group(['prefix' => 'leaf-count'], function () {
        Route::get('/', [
            "uses"  => "FineLeafController@index",
            "as"    => "fine-leaf.index"
        ]);
        Route::post('/create', [
            "uses"  => "FineLeafController@store",
            "as"    => "fine-leaf.create"
        ]);
        Route::get('/ajax-data', [
            "uses"  => "FineLeafController@ajaxData",
            "as"    => "fine-leaf.ajax-data"
        ]);
        Route::get('/edit/{model}', [
            "uses"  => "FineLeafController@edit",
            "as"    => "fine-leaf.edit"
        ]);
        Route::post('/edit/{model}', [
            "uses"  => "FineLeafController@update",
            "as"    => "fine-leaf.update"
        ]);
        Route::get('/delete/{model}', [
            "uses"  => "FineLeafController@destroy",
            "as"    => "fine-leaf.destroy"
        ]);
        Route::get('/activate/{model}', [
            "uses"  => "FineLeafController@activate",
            "as"    => "fine-leaf.activate"
        ]);
    });
    Route::group(['prefix' => 'reports'], function () {
        Route::get("vendor-offers", [
            "uses" => 'FactoryController@vendorOffers',
            "as"   => "offer.index",
            "middleware"    => "factory_slab"
        ]);
        Route::get("summary-report", [
            "uses" => 'FactoryController@summaryReport',
            "as"   => "offer.summary-report",
            "middleware"    => "factory_slab"
        ]);
    });
});
