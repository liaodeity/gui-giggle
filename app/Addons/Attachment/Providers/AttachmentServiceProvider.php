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
namespace App\Addons\Attachment\Providers;

use App\Addons\Attachment\Commands\AttachmentCommand;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AttachmentServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Addons\Attachment\Http\Controllers';

    protected $listen = [];

    //视图组件：Addons\Attachment\Components\Name:class,
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
                AttachmentCommand::class,
            ]);
        }

        // 事件注册
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        $this->mergeConfigFrom(addons_path ('Attachment/config/attachment.php'),'attachment');

        $this->loadMigrationsFrom (addons_path ('Attachment/migrations'));

        $this->loadTranslationsFrom(addons_path ('Attachment/lang'), 'attachment');

        $this->loadViewComponentsAs ('attachment',$this->components);

        $this->loadViewsFrom (addons_path ('Attachment/views'), 'attachment');

        Route::middleware ('web')
            ->namespace ($this->namespace)
            ->group (addons_path ('Attachment/routes/web.php'));

        Route::prefix ('api')
            ->middleware ('api')
            ->namespace ($this->namespace)
            ->group (addons_path ('Attachment/routes/api.php'));
    }
}
