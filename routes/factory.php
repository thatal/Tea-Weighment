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
        "as"   => "dashboard"
    ]);
    Route::get("switch-available", [
        "uses" => 'DashboardController@switchAvailable',
        "as"   => "switch-available"
    ]);
    Route::get("offer-accept/{vendorOffer}", [
        "uses" => 'DashboardController@confirmOrder',
        "as"   => "offer.accept"
    ]);
    Route::get("offer-cancel/{vendorOffer}", [
        "uses" => 'DashboardController@cancelOffer',
        "as"   => "offer.cancel"
    ]);
    Route::group(['prefix' => 'reports'], function () {
        Route::get("vendor-offers", [
            "uses" => 'FactoryController@vendorOffers',
            "as"   => "offer.index"
        ]);
    });
});
