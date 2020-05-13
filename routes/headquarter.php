<?php

// headquarter rotues here
Route::group(['prefix' => 'headquarter', "as" => "headquarter.", "namespace" => "Headquarter", "middleware" => "headquarter"], function () {
    Route::get("/dashboard", [
        "as"    => "dashboard",
        "uses"  => "DashboardController@dashboard"
    ]);
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
});
