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
    Route::group (['prefix' => 'parameter'], function () {
        Route::get ('/', 'ParameterController@index');
        Route::get ('/create', 'ParameterController@create');
        Route::post ('/', 'ParameterController@store');
        Route::get ('/{parameter}', 'ParameterController@show');
        Route::get ('/{parameter}/edit', 'ParameterController@edit');
        Route::put ('/{parameter}', 'ParameterController@update');
        Route::delete ('/{parameter}', 'ParameterController@destroy');
        Route::delete ('/delete/batch/{ids}', 'ParameterController@batchDestroy');
    });
    Route::group (['prefix' => 'parameter_item'], function () {
        Route::get ('/', 'ParameterItemController@index');
        Route::get ('/create', 'ParameterItemController@create');
        Route::post ('/', 'ParameterItemController@store');
        Route::get ('/{parameterItem}', 'ParameterItemController@show');
        Route::get ('/{parameterItem}/edit', 'ParameterItemController@edit');
        Route::put ('/{parameterItem}', 'ParameterItemController@update');
        Route::delete ('/{parameterItem}', 'ParameterItemController@destroy');
        Route::delete ('/delete/batch/{ids}', 'ParameterItemController@batchDestroy');
    });
});
