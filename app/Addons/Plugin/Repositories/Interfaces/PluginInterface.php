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
namespace App\Addons\Plugin\Repositories\Interfaces;


use App\Addons\Plugin\Models\Plugin;
use App\Repositories\BaseInterface;

interface PluginInterface extends BaseInterface
{
    /**
     * @param Plugin $plugin
     * @return boolean;
     */
    public function allowDelete (Plugin $plugin);
}
