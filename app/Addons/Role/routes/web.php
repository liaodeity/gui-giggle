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
    Route::group (['prefix' => 'role_info'], function () {
        Route::get ('/', 'RoleInfoController@index');
        Route::get ('/create', 'RoleInfoController@create');
        Route::post ('/', 'RoleInfoController@store');
        Route::get ('/{roleInfo}', 'RoleInfoController@show');
        Route::get ('/{roleInfo}/edit', 'RoleInfoController@edit');
        Route::put ('/{roleInfo}', 'RoleInfoController@update');
        Route::delete ('/{roleInfo}', 'RoleInfoController@destroy');
        Route::delete ('/delete/batch/{ids}', 'RoleInfoController@batchDestroy');
    });
});
