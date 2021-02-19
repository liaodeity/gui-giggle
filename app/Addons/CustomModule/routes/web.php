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
    Route::group (['prefix' => 'module'], function () {
        Route::get ('/', 'ModuleController@index');
        Route::get ('/create', 'ModuleController@create');
        Route::post ('/', 'ModuleController@store');
        Route::get ('/{module}', 'ModuleController@show');
        Route::get ('/{module}/edit', 'ModuleController@edit');
        Route::put ('/{module}', 'ModuleController@update');
        Route::delete ('/{module}', 'ModuleController@destroy');
        Route::delete ('/delete/batch/{ids}', 'ModuleController@batchDestroy');
    });
});
