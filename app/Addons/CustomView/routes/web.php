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
    Route::group (['prefix' => 'custom_view'], function () {
        Route::get ('/', 'CustomViewController@index');
        Route::get ('/create', 'CustomViewController@create');
        Route::post ('/', 'CustomViewController@store');
        Route::get ('/{customView}', 'CustomViewController@show');
        Route::get ('/{customView}/edit', 'CustomViewController@edit');
        Route::put ('/{customView}', 'CustomViewController@update');
        Route::delete ('/{customView}', 'CustomViewController@destroy');
        Route::delete ('/delete/batch/{ids}', 'CustomViewController@batchDestroy');
    });
});
