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
namespace App\Addons\Console\Providers;

use App\Addons\Console\Commands\ConsoleCommand;
use App\Addons\Console\Components\MainAccountGroup;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020-07-28
 */
class ConsoleServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\Console\Http\Controllers';

    protected $listen = [];
    protected   $components = [
        MainAccountGroup::class
    ];

    public function register ()
    {

    }

    public function boot ()
    {
        // 注册路由

        if ($this->app->runningInConsole ()) {
            $this->commands ([
                ConsoleCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        $this->publishes([
            addons_path ('Console/assets') => public_path('vendor/console'),
        ], 'public');


        $this->loadTranslationsFrom(addons_path ('Console/lang'), 'console');

        $this->loadViewComponentsAs ('console', $this->components);

        $this->loadViewsFrom (addons_path ('Console/views'), 'console');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('Console/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('Console/routes/api.php'));
    }
}
