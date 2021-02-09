<?php

// headquarter rotues here
Route::group(['prefix' => 'headquarter', "as" => "headquarter.", "namespace" => "Headquarter", "middleware" => "headquarter"], function () {
    Route::get("/dashboard", [
        "as"    => "dashboard",
        "uses"  => "DashboardController@dashboard"
    ]);
    Route::get("/change-password", [
        "as"    => "change-password",
        "uses"  => "LoginController@changePassword"
    ]);
    Route::post("/change-password", [
        "as"    => "change-password.post",
        "uses"  => "LoginController@changePasswordPost"
    ]);
    Route::group(['prefix' => 'vendor'], function () {
        Route::get("/", [
            "uses"  => "VendorController@index",
            "as"  => "vendor.index",
        ]);
    });
    Route::resource('factory', 'FactoryController')->except("destroy");
    Route::group(['prefix' => 'factory'], function () {
        Route::get("/destroy/{factory}", [
            "as"    => "factory.destroy",
            "uses"    => "FactoryController@destroy"
        ]);
        Route::get("/reset-pass/{factory}", [
            "as"    => "factory.reset",
            "uses"    => "FactoryController@passwordReset"
        ]);
        Route::get("/login-as/{factory}", [
            "as"    => "factory.loginas",
            "uses"    => "FactoryController@loginAsFactory"
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
    });
    Route::post('/add-final-price/{vendor_offer}', [
        "uses" => "HeadquarterController@addPriceToVendorOffer",
        "as"   => "fine-leaf.add-price",
    ]);

    Route::get("offer-accept/{vendorOffer}", [
        "uses" => 'DashboardController@confirmOrder',
        "as"   => "offer.accept",
    ]);
    Route::get("offer-cancel/{vendorOffer}", [
        "uses" => 'DashboardController@cancelOffer',
        "as"   => "offer.cancel",
    ]);
    Route::post("counter-offer/{vendorOffer}", [
        "uses" => 'DashboardController@counterOffer',
        "as"   => "counter.offer",
    ]);
    Route::group(['prefix' => 'reports'], function () {
        Route::get("vendor-offers", [
            "uses" => 'HeadquarterController@vendorOffers',
            "as"   => "offer.index",
        ]);
        Route::get("summary-report", [
            "uses" => 'HeadquarterController@summaryReport',
            "as"   => "offer.summary-report",
        ]);
    });
    Route::group(['prefix' => 'vendor'], function () {
        Route::post("/change_status/{vendor}", [
            "uses"  => "VendorController@changeStatus",
            "as"  => "vendor.change-status",
        ]);
    });
});
