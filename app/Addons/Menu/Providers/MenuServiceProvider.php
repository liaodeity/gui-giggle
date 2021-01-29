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
namespace App\Addons\Menu\Providers;

use App\Addons\Menu\Commands\MenuCommand;
use App\Addons\Menu\Components\BreadcrumbPath;
use App\Addons\Menu\Components\NavMenu;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020-07-10
 */
class MenuServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\Menu\Http\Controllers';

    protected $listen = [];
    protected $components = [
        BreadcrumbPath::class,
        NavMenu::class
    ];
    public function register ()
    {

    }

    public function boot ()
    {
        // 注册路由

        if ($this->app->runningInConsole ()) {
            $this->commands ([
                MenuCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }


        //$this->publishes([
        //    addons_path ('Menu/config/menu.php') => config_path('menu.php'),
        //], 'config');
        #php artisan vendor:publish --tag=config --force

        $this->publishes([
            addons_path ('Menu/assets') => public_path('vendor/menu'),
        ], 'public');
        #php artisan vendor:publish --tag=public --force
        $this->loadMigrationsFrom (addons_path ('Menu/migrations'));

        $this->loadTranslationsFrom(addons_path ('Menu/lang'), 'menu');

        $this->loadViewComponentsAs ('menu', $this->components);

        $this->loadViewsFrom (addons_path ('Menu/views'), 'menu');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('Menu/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('Menu/routes/api.php'));
    }
}
