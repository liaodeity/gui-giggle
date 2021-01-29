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
namespace App\Addons\Console\Http\Controllers;

use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\QueryWhere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\View;

class ConsoleController extends Controller
{
    /**
     * 后台入口
     * add by gui
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('console::console.index');
    }
    /**
     * add by gui
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');

        return ajax_success_message('清除缓存成功');
    }

    /**
     * 退出
     * add by gui
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        session ()->flush ();
        return redirect(route('admin-login'));
    }
}

