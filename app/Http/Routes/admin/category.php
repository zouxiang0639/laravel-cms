<?php
Route::group(['prefix'=>'category', 'middleware' => config('admin.filter.auth')], function () {
    Route::get("/", ['uses' => "Admin\\Category\\CategoryController@index", 'as' => 'admin.category.list']);
    Route::get("/create", ['uses' => "Admin\\Category\\CategoryController@create", 'as' => 'admin.category.create']);
    Route::post("/store", ['uses' => "Admin\\Category\\CategoryController@store", 'as' => 'admin.category.store']);
    Route::get("/edit/{id}", ['uses' => "Admin\\Category\\CategoryController@edit", 'as' => 'admin.category.edit'])->where('id', '[0-9]+');;
    Route::post("/update/{id}", ['uses' => "Admin\\Category\\CategoryController@update", 'as' => 'admin.category.update'])->where('id', '[0-9]+');;
    Route::post("/sort", ['uses' => "Admin\\Category\\CategoryController@sort", 'as' => 'admin.category.sort']);
});