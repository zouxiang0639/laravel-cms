<?php


Route::group([], function () {
    Route::get("/index", ['uses' => "Admin\\PublicController@index", 'as' => 'admin.index']);
    Route::get("/left/menu", ['uses' => "Admin\\PublicController@leftMenu", 'as' => 'admin.left.menu']);
});