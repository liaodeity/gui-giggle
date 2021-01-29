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
    Route::group (['prefix' => 'config'], function () {
        Route::get ('/', 'ConfigController@index');
        Route::get ('/create', 'ConfigController@create');
        Route::post ('/', 'ConfigController@store');
        Route::get ('/{config}', 'ConfigController@show');
        Route::get ('/{config}/edit', 'ConfigController@edit');
        Route::put ('/{config}', 'ConfigController@update');
        Route::delete ('/{config}', 'ConfigController@destroy');
        Route::delete ('/delete/batch/{ids}', 'ConfigController@batchDestroy');
    });
});
