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
namespace App\Addons\Role\Repositories\Interfaces;


use App\Addons\Role\Models\RoleInfo;
use App\Repositories\BaseInterface;

interface RoleInfoInterface extends BaseInterface
{
    /**
     * @param RoleInfo $roleInfo
     * @return boolean;
     */
    public function allowDelete (RoleInfo $roleInfo);
}
