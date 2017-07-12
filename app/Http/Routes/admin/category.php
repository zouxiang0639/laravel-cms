<?php
Route::group(['prefix'=>'category', 'middleware' => config('admin.filter.auth')], function () {
    Route::get("/", ['uses' => "Admin\\CategoryController@index", 'as' => 'admin.category.list']);
    Route::get("/create", ['uses' => "Admin\\CategoryController@create", 'as' => 'admin.category.create']);
    Route::post("/store", ['uses' => "Admin\\CategoryController@store", 'as' => 'admin.category.store']);
    Route::get("/edit", ['uses' => "Admin\\CategoryController@edit", 'as' => 'admin.category.edit']);
});