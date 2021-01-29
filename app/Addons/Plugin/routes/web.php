<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: Gui < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/
//
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::group (['prefix' => 'plugin'], function () {
        Route::get ('/', 'PluginController@index');
        Route::get ('/create', 'PluginController@create');
        Route::post ('/', 'PluginController@store');
        Route::get ('/{plugin}', 'PluginController@show');
        Route::get ('/{plugin}/edit', 'PluginController@edit');
        Route::put ('/{plugin}', 'PluginController@update');
        Route::delete ('/{plugin}', 'PluginController@destroy');
        Route::delete ('/delete/batch/{ids}', 'PluginController@batchDestroy');
    });
});
