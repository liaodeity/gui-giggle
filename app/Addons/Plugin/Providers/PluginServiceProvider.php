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
namespace App\Addons\Plugin\Providers;

use App\Addons\Plugin\Commands\PluginCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020-07-28
 */
class PluginServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\Plugin\Http\Controllers';

    protected $listen = [];

    public function register ()
    {

    }

    public function boot ()
    {
        // 注册路由

        if ($this->app->runningInConsole ()) {
            $this->commands ([
                PluginCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }


        //$this->publishes([
        //    addons_path ('Plugin/config/plugin.php') => config_path('plugin.php'),
        //], 'config');
        #php artisan vendor:publish --tag=config --force

        $this->publishes([
            addons_path ('Plugin/assets') => public_path('vendor/plugin'),
        ], 'public');
        #php artisan vendor:publish --tag=public --force
        $this->loadMigrationsFrom (addons_path ('Plugin/migrations'));

        $this->loadTranslationsFrom(addons_path ('Plugin/lang'), 'plugin');

        $this->loadViewsFrom (addons_path ('Plugin/views'), 'plugin');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('Plugin/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('Plugin/routes/api.php'));
    }
}
