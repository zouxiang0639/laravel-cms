<?php
Route::group(['prefix'=>'page', 'middleware' => config('admin.filter.auth')], function () {
    Route::get("/", ['uses' => "Admin\\Page\\PageController@index", 'as' => 'admin.page.list']);
    Route::get("/create", ['uses' => "Admin\\Page\\PageController@create", 'as' => 'admin.page.create']);
    Route::post("/store", ['uses' => "Admin\\Page\\PageController@store", 'as' => 'admin.page.store']);
    Route::get("/edit/{id}", ['uses' => "Admin\\Page\\PageController@edit", 'as' => 'admin.page.edit'])->where('id', '[0-9]+');
    Route::post("/update/{id}", ['uses' => "Admin\\Page\\PageController@update", 'as' => 'admin.page.update'])->where('id', '[0-9]+');
    Route::delete("/destroy", ['uses' => "Admin\\Page\\PageController@destroy", 'as' => 'admin.page.destroy']);
});