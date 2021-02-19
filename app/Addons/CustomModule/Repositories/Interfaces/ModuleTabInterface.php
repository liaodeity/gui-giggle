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

namespace App\Addons\CustomModule\Repositories\Interfaces;


use App\Addons\CustomModule\Models\ModuleTab;
use App\Repositories\BaseInterface;

interface ModuleTabInterface extends BaseInterface
{
    /**
     * @param ModuleTab $moduleTab
     * @return boolean;
     */
    public function allowDelete (ModuleTab $moduleTab);
}
