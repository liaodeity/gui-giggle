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
namespace App\Addons\CustomView\Providers;

use App\Addons\CustomView\Commands\CustomViewCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CustomViewServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\CustomView\Http\Controllers';

    protected $listen = [];

    //视图组件：Addons\CustomView\Components\Name:class,
    protected $components = [

    ];

    public function register ()
    {

    }

    public function boot ()
    {
        // 注册控制器
        if ($this->app->runningInConsole ()) {
            $this->commands ([
                CustomViewCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        $this->mergeConfigFrom(addons_path ('CustomView/config/custom_view.php'),'custom_view');

        $this->loadMigrationsFrom (addons_path ('CustomView/migrations'));

        $this->loadTranslationsFrom(addons_path ('CustomView/lang'), 'custom_view');

        $this->loadViewComponentsAs ('custom_view',$this->components);

        $this->loadViewsFrom (addons_path ('CustomView/views'), 'custom_view');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('CustomView/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('CustomView/routes/api.php'));
    }
}
