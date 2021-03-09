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
namespace App\Addons\Login\Providers;

use App\Addons\Login\Commands\LoginCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LoginServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\Login\Http\Controllers';

    protected $listen = [];

    //视图组件：Addons\Login\Components\Name:class,
    protected $components = [

    ];

    public function register ()
    {

    }

    public function boot ()
    {
        return true;
        // 注册控制器
        if ($this->app->runningInConsole ()) {
            $this->commands ([
                LoginCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        $this->mergeConfigFrom(addons_path ('Login/config/login.php'),'login');
        //$this->publishes([addons_path ('Login/config/login.php') => config_path('login.php')], 'login');
        #php artisan vendor:publish --tag=login --force

        //$this->publishes([addons_path ('Login/assets') => public_path('vendor/login')], 'login');
        #php artisan vendor:publish --tag=login --force

        $this->loadMigrationsFrom (addons_path ('Login/migrations'));

        $this->loadTranslationsFrom(addons_path ('Login/lang'), 'login');

        $this->loadViewComponentsAs ('login',$this->components);

        $this->loadViewsFrom (addons_path ('Login/views'), 'login');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('Login/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('Login/routes/api.php'));
    }
}
