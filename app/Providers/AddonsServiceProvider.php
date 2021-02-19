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
namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AddonsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register ()
    {
        $file  = 'addons_map.json';
        $exits = Storage::exists ($file);
        if (!$exits || config ('app.debug')) {
            $addons = Storage::disk ('base')->directories ('app/Addons');
            if ($addons) {
                $map = [];
                foreach ($addons as $addon) {
                    list($app,$addon, $module) = explode ('/', $addon);
                    //TODO 判断禁用的插件
                    $map[] = 'App\\Addons\\' . $module . '\\Providers\\' . $module . 'ServiceProvider';
                }
                $content = json_encode ($map, JSON_PRETTY_PRINT);
                Storage::put ($file, $content);
            }
        }
        $map       = Storage::get ($file);
        $providers = json_decode ($map, true);
        if ($providers) {
            array_map (function ($provider) {
                if (class_exists ($provider))
                    $this->app->register ($provider);
            }, $providers);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot ()
    {
        //
    }
}
