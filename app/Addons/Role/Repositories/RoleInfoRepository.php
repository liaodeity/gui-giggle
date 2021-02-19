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
namespace App\Addons\Role\Repositories;

use App\Addons\Role\Models\RoleInfo;
use App\Addons\Role\Repositories\Interfaces\RoleInfoInterface;
use App\Addons\Role\Validators\RoleInfoValidator;
use App\Repositories\BaseRepository;
/**
 * Class RoleInfoRepository.
 * @package namespace App\Repositories\Role;
 */
class RoleInfoRepository extends BaseRepository implements RoleInfoInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return RoleInfo::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return RoleInfoValidator::class;
    }
    /**
     * @param RoleInfo $roleInfo
     * @return boolean;
     */
    public function allowDelete(RoleInfo $roleInfo)
    {
        return true;
    }
}
