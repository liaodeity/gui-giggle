<?php

namespace App\Addons\User\Providers;

use App\Addons\User\Commands\UserCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * Created by liaodeity@gmail.com
 * User: gui
 * Date: 2020-07-14
 */
class UserServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\User\Http\Controllers';

    protected $listen = [];

    public function register ()
    {

    }

    public function boot ()
    {
        // 注册路由

        if ($this->app->runningInConsole ()) {
            $this->commands ([
                UserCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }


        //$this->publishes([
        //    addons_path ('User/config/user.php') => config_path('user.php'),
        //], 'config');
        #php artisan vendor:publish --tag=config --force

        $this->publishes([
            addons_path ('User/assets') => public_path('vendor/user'),
        ], 'public');
        #php artisan vendor:publish --tag=public --force
        $this->loadMigrationsFrom (addons_path ('User/migrations'));

        $this->loadTranslationsFrom(addons_path ('User/lang'), 'user');

        $this->loadViewsFrom (addons_path ('User/views'), 'user');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('User/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('User/routes/api.php'));
    }
}
