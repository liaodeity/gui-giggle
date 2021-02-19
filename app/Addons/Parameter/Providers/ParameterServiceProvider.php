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
namespace App\Addons\Parameter\Providers;

use App\Addons\Parameter\Commands\ParameterCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020-07-28
 */
class ParameterServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\Parameter\Http\Controllers';

    protected $listen = [];

    public function register ()
    {

    }

    public function boot ()
    {
        // 注册路由

        if ($this->app->runningInConsole ()) {
            $this->commands ([
                ParameterCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }


        //$this->publishes([
        //    addons_path ('Parameter/config/parameter.php') => config_path('parameter.php'),
        //], 'config');
        #php artisan vendor:publish --tag=config --force

        $this->publishes([
            addons_path ('Parameter/assets') => public_path('vendor/parameter'),
        ], 'public');
        #php artisan vendor:publish --tag=public --force
        $this->loadMigrationsFrom (addons_path ('Parameter/migrations'));

        $this->loadTranslationsFrom(addons_path ('Parameter/lang'), 'parameter');

        $this->loadViewsFrom (addons_path ('Parameter/views'), 'parameter');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('Parameter/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('Parameter/routes/api.php'));
    }
}
