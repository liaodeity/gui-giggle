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

namespace App\Addons\CustomView\Repositories\Interfaces;


use App\Addons\CustomView\Models\CustomViewCondition;
use App\Repositories\BaseInterface;

interface CustomViewConditionInterface extends BaseInterface
{
    /**
     * @param CustomViewCondition $customViewCondition
     * @return boolean;
     */
    public function allowDelete (CustomViewCondition $customViewCondition);
}
