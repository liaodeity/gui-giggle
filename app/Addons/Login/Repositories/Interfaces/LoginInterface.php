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

namespace App\Addons\Login\Repositories\Interfaces;


use App\Addons\Login\Models\Login;
use App\Repositories\BaseInterface;

interface LoginInterface extends BaseInterface
{
    /**
     * @param Login $login
     * @return boolean;
     */
    public function allowDelete (Login $login);
}
