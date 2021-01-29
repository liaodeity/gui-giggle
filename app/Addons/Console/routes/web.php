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
    Route::get('/', 'ConsoleController@index');
    Route::post ('uploads/editor','SystemGui\UploadController@image')->name('admin_upload_editor');
    Route::group (['prefix' => 'console'], function () {
        Route::get('/', 'ConsoleController@index')->name('admin-index');
        //Route::get ('/', 'ConsoleController@index');
        Route::get('/logout', 'ConsoleController@logout')->name('admin-logout');
        //Route::any('/init', 'SystemGui\MainController@init')->name('admin-init');
        Route::get('/clear', 'ConsoleController@clear')->name('admin-clear');
    });
});
