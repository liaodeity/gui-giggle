<?php
/**
 * Created by liaodeity@gmail.com
 * User: gui
 * Date: 2020-07-14
 */

//
Route::prefix('admin')->middleware(['admin'])->group(function () {

    Route::group (['prefix' => 'user'], function () {
        Route::get ('/', 'UserController@index');
        Route::get ('/create', 'UserController@create');
        Route::post ('/', 'UserController@store');
        Route::get ('/{user}', 'UserController@show');
        Route::get ('/{user}/edit', 'UserController@edit');
        Route::put ('/{user}', 'UserController@update');
        Route::delete ('/{user}', 'UserController@destroy');
        Route::delete ('/delete/batch/{ids}', 'UserController@batchDestroy');
    });

    Route::group (['prefix' => 'user_admin'], function () {
        Route::get ('/', 'UserAdminController@index');
        Route::get ('/create', 'UserAdminController@create');
        Route::post ('/', 'UserAdminController@store');
        Route::get ('/{userAdmin}', 'UserAdminController@show');
        Route::get ('/{userAdmin}/edit', 'UserAdminController@edit');
        Route::put ('/{userAdmin}', 'UserAdminController@update');
        Route::delete ('/{userAdmin}', 'UserAdminController@destroy');
        Route::delete ('/delete/batch/{ids}', 'UserAdminController@batchDestroy');
    });
});
