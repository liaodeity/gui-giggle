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
namespace App\Addons\Config\Providers;

use App\Addons\Config\Commands\ConfigCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020-07-10
 */
class ConfigServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\Config\Http\Controllers';

    protected $listen = [];

    public function register ()
    {

    }

    public function boot ()
    {
        // 注册路由

        //if ($this->app->runningInConsole ()) {
        //    $this->commands ([
        //        ConfigCommand::class,
        //    ]);
        //}

        // 事件注册
        //foreach ($this->listen as $event => $listeners) {
        //    foreach ($listeners as $listener) {
        //        Event::listen($event, $listener);
        //    }
        //}


        //$this->publishes([
        //    addons_path ('Config/config/config.php') => config_path('config.php'),
        //], 'config');
        #php artisan vendor:publish --tag=config --force

        $this->publishes([
            addons_path ('Config/assets') => public_path('vendor/config'),
        ], 'public');
        #php artisan vendor:publish --tag=public --force
        $this->loadMigrationsFrom (addons_path ('Config/migrations'));

        $this->loadTranslationsFrom(addons_path ('Config/lang'), 'config');

        $this->loadViewsFrom (addons_path ('Config/views'), 'config');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('Config/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('Config/routes/api.php'));
    }
}
