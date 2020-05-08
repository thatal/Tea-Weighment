<?php

// admin routes here
Route::group(['prefix' => 'admin', "as" => "admin.", "namespace" => "Admin"], function () {
    Route::get("/", [
        "as"    => "root",
        "uses"  => "DashboardController@index"
    ]);
    Route::get("/dashboard", [
        "as"    => "dashboard",
        "uses"  => "DashboardController@dasboard"
    ]);
});
