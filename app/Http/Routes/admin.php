<?php
Route::group(['prefix'=>'admin'], function(){
    require 'admin/login.php';
    require 'admin/public.php';
    require 'admin/category.php';
    require 'admin/file.php';

});