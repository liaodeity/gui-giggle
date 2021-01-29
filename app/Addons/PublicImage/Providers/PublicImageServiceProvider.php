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
namespace App\Addons\PublicImage\Providers;

use App\Addons\PublicImage\Commands\PublicImageCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PublicImageServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\PublicImage\Http\Controllers';

    protected $listen = [];

    //视图组件：Addons\PublicImage\Components\Name:class,
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
                PublicImageCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        $this->mergeConfigFrom(addons_path ('PublicImage/config/public_image.php'),'public_image');

        $this->loadMigrationsFrom (addons_path ('PublicImage/migrations'));

        $this->loadTranslationsFrom(addons_path ('PublicImage/lang'), 'public_image');

        $this->loadViewComponentsAs ('public_image',$this->components);

        $this->loadViewsFrom (addons_path ('PublicImage/views'), 'public_image');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('PublicImage/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('PublicImage/routes/api.php'));
    }
}
