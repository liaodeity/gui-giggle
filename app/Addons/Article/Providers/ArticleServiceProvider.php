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
namespace App\Addons\Article\Providers;

use App\Addons\Article\Commands\ArticleCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ArticleServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\Article\Http\Controllers';

    protected $listen = [];

    //视图组件：Addons\Article\Components\Name:class,
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
                ArticleCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        $this->mergeConfigFrom(addons_path ('Article/config/article.php'),'article');
        //$this->publishes([addons_path ('Article/config/article.php') => config_path('article.php')], 'article');
        #php artisan vendor:publish --tag=article --force

        $this->loadMigrationsFrom (addons_path ('Article/migrations'));

        $this->loadTranslationsFrom(addons_path ('Article/lang'), 'article');

        $this->loadViewComponentsAs ('article',$this->components);

        $this->loadViewsFrom (addons_path ('Article/views'), 'article');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('Article/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('Article/routes/api.php'));
    }
}
