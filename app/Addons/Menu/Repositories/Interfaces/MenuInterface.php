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
namespace App\Addons\Menu\Repositories\Interfaces;


use App\Addons\Menu\Models\Menu;
use App\Repositories\BaseInterface;

interface MenuInterface extends BaseInterface
{
    /**
     * @param Menu $menu
     * @return boolean;
     */
    public function allowDelete (Menu $menu);
}
