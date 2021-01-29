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
    Route::group (['prefix' => 'menu'], function () {
        Route::get ('/', 'MenuController@index');
        Route::get ('/create', 'MenuController@create');
        Route::post ('/', 'MenuController@store');
        Route::get ('/{menu}', 'MenuController@show');
        Route::get ('/{menu}/edit', 'MenuController@edit');
        Route::put ('/{menu}', 'MenuController@update');
        Route::delete ('/{menu}', 'MenuController@destroy');
        Route::delete ('/delete/batch/{ids}', 'MenuController@batchDestroy');
    });
});
