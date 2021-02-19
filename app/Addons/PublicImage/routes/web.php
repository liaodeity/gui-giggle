<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( MIT )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: Gui < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

//
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::group (['prefix' => 'image'], function () {
        Route::get ('/', 'ImageController@image');
        Route::get ('/replace', 'ImageController@replace');
        Route::post ('/upload', 'ImageController@upload');
        //Route::get ('/create', 'ImageController@create');
        //Route::post ('/', 'ImageController@store');
        //Route::get ('/{image}', 'ImageController@show');
        //Route::get ('/{image}/edit', 'ImageController@edit');
        //Route::put ('/{image}', 'ImageController@update');
        //Route::delete ('/{image}', 'ImageController@destroy');
        //Route::delete ('/delete/batch/{ids}', 'ImageController@batchDestroy');
    });
});
