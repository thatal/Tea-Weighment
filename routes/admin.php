<?php

// admin routes here
Route::group(['prefix' => 'admin', "as" => "admin.", "namespace" => "Admin", "middleware" => ["auth", "admin"]], function () {
    Route::get("/", [
        "as"    => "root",
        "uses"  => "DashboardController@index"
    ]);
    Route::get("/dashboard", [
        "as"    => "dashboard",
        "uses"  => "DashboardController@dasboard"
    ]);
    Route::group(['prefix' => 'factory'], function () {
        Route::get("/", [
            "as"    => "factory.index",
            "uses"    => "FactoryController@index"
        ]);
    });
    Route::group(['prefix' => 'vehicle'], function () {
        Route::get("/", [
            "as"    => "vehicle.index",
            "uses"    => "VehicleController@index"
        ]);
        Route::get("/create", [
            "as"    => "vehicle.create",
            "uses"    => "VehicleController@create"
        ]);
        Route::post("/create", [
            "as"    => "vehicle.store",
            "uses"    => "VehicleController@store"
        ]);
        Route::get("/destroy/{vehicle}", [
            "as"    => "vehicle.destroy",
            "uses"    => "VehicleController@destroy"
        ]);
        Route::get("/edit/{vehicle}", [
            "as"    => "vehicle.edit",
            "uses"    => "VehicleController@edit"
        ]);
        Route::post("/edit/{vehicle}", [
            "as"    => "vehicle.update",
            "uses"    => "VehicleController@update"
        ]);
    });
});
