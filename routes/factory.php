<?php

// factory routes here
Route::group(['prefix' => 'factory', "as" => "factory.", "namespace" => "Factory"], function () {
    Route::get("dashboard", [
        "uses" => 'DashboardController@dashboard',
        "as"   => "dashboard"
    ]);
});
