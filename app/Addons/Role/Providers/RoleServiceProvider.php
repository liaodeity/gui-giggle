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
namespace App\Addons\Role\Providers;

use App\Addons\Role\Commands\RoleCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020-07-28
 */
class RoleServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\Role\Http\Controllers';

    protected $listen = [];

    public function register ()
    {

    }

    public function boot ()
    {
        // 注册路由

        if ($this->app->runningInConsole ()) {
            $this->commands ([
                RoleCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }


        //$this->publishes([
        //    addons_path ('Role/config/role.php') => config_path('role.php'),
        //], 'config');
        #php artisan vendor:publish --tag=config --force

        $this->publishes([
            addons_path ('Role/assets') => public_path('vendor/role'),
        ], 'public');
        #php artisan vendor:publish --tag=public --force
        $this->loadMigrationsFrom (addons_path ('Role/migrations'));


        $this->loadTranslationsFrom(addons_path ('Role/lang'), 'role');

        $this->loadViewsFrom (addons_path ('Role/views'), 'role');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('Role/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('Role/routes/api.php'));
    }
}
