<?php
/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2021/3/3
 */

//登录入口
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::name ('admin.')->prefix ('admin')->group (function () {
    Route::get ('login', [LoginController::class, 'admin'])->name ('admin-login');
    Route::post ('login_check', [LoginController::class, 'check'])->name ('login.check');
    Route::get ('login_captcha', [LoginController::class, 'captcha'])->name ('login.captcha');
});
