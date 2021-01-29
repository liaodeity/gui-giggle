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
namespace App\Addons\CustomModule\Providers;

use App\Addons\CustomModule\Commands\CustomModuleCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CustomModuleServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\CustomModule\Http\Controllers';

    protected $listen = [];

    //视图组件：Addons\CustomModule\Components\Name:class,
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
                CustomModuleCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        $this->mergeConfigFrom(addons_path ('CustomModule/config/custom_module.php'),'custom_module');

        $this->loadMigrationsFrom (addons_path ('CustomModule/migrations'));

        $this->loadTranslationsFrom(addons_path ('CustomModule/lang'), 'custom_module');

        $this->loadViewComponentsAs ('custom_module',$this->components);

        $this->loadViewsFrom (addons_path ('CustomModule/views'), 'custom_module');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('CustomModule/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('CustomModule/routes/api.php'));
    }
}
