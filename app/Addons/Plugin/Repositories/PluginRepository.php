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
namespace App\Addons\Plugin\Repositories;

use App\Addons\Plugin\Models\Plugin;
use App\Addons\Plugin\Repositories\Interfaces\PluginInterface;
use App\Addons\Plugin\Validators\PluginValidator;
use App\Repositories\BaseInterface;
use App\Repositories\BaseRepository;
/**
 * Class PluginRepository.
 * @package namespace App\Repositories\Plugin;
 */
class PluginRepository extends BaseRepository implements PluginInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Plugin::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return PluginValidator::class;
    }
    /**
     * @param Plugin $plugin
     * @return boolean;
     */
    public function allowDelete(Plugin $plugin)
    {
        return true;
    }
}
