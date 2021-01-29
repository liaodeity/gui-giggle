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
//登录入口
Route::get('/admin/login', 'LoginController@admin')->name('admin-login');
Route::post('/admin/login_check', 'LoginController@check')->name('admin-login-check');
Route::get('/admin/login_captcha', 'LoginController@captcha')->name('admin-login-captcha');
