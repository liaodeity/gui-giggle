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
    Route::group (['prefix' => 'attachment'], function () {
        Route::get ('/', 'AttachmentController@index');
        Route::get ('/create', 'AttachmentController@create');
        Route::post ('/', 'AttachmentController@store');
        Route::get ('/{attachment}', 'AttachmentController@show');
        Route::get ('/{attachment}/edit', 'AttachmentController@edit');
        Route::put ('/{attachment}', 'AttachmentController@update');
        Route::delete ('/{attachment}', 'AttachmentController@destroy');
        Route::delete ('/delete/batch/{ids}', 'AttachmentController@batchDestroy');
    });
});
