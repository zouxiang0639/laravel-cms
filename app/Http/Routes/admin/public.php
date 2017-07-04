<?php


Route::group(['middleware' => config('admin.filter.auth')], function () {
    Route::get("/index", ['uses' => "Admin\\PublicController@index", 'as' => 'admin.index']);
    Route::get("/main", ['uses' => "Admin\\PublicController@main", 'as' => 'admin.main']);
    Route::get("/logout", ['uses' => "Admin\\PublicController@logout", 'as' => 'admin.logout']);
});