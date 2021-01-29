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
    Route::group (['prefix' => 'article'], function () {
        Route::get ('/', 'ArticleController@index');
        Route::get ('/create', 'ArticleController@create');
        Route::post ('/', 'ArticleController@store');
        Route::get ('/{article}', 'ArticleController@show');
        Route::get ('/{article}/edit', 'ArticleController@edit');
        Route::put ('/{article}', 'ArticleController@update');
        Route::delete ('/{article}', 'ArticleController@destroy');
        Route::delete ('/delete/batch/{ids}', 'ArticleController@batchDestroy');
    });
});
