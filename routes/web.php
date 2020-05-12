<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route("login");
    return view('auth.login2');
});
// Route::fallback(function(){
//     return view("layouts.react");
// });
Route::group(['prefix' => 'admin', "as" => "admin."], function () {
    Auth::routes();
});

Route::get("/login", [
    "as"   => "login",
    "uses" => "Headquarter\LoginController@getForm",
]);

Route::post("/login", [
    "as"   => "login.post",
    "uses" => "Headquarter\LoginController@login",
]);

Route::post("/logout", [
    "as"   => "logout",
    "uses" => "Headquarter\LoginController@logout",
]);

Route::group(['prefix' => 'factory', "as" => "factory."], function () {
    Route::get("/login", [
        "as"   => "login",
        "uses" => "Factory\LoginController@getForm",
    ]);

    Route::post("/login", [
        "as"   => "login.post",
        "uses" => "Factory\LoginController@login",
    ]);

    Route::post("/logout", [
        "as"   => "logout",
        "uses" => "Factory\LoginController@logout",
    ]);
});
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
