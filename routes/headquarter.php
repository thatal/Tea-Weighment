<?php

// headquarter rotues here
Route::group(['prefix' => 'headquarter', "as" => "headquarter.", "namespace" => "Headquarter", "middleware" => "headquarter"], function () {
    Route::get("/dashboard", [
        "as"    => "dashboard",
        "uses"  => "DashboardController@dashboard"
    ]);
Route::resource('factory', 'FactoryController');
});
