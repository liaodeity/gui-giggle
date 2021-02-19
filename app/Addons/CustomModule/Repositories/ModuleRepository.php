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

namespace App\Addons\CustomModule\Repositories;

use App\Addons\CustomModule\Models\Module;
use App\Addons\CustomModule\Repositories\Interfaces\ModuleInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomModule\Validators\ModuleValidator;
/**
 * Class ModuleRepository.
 * @package namespace App\Addons\CustomModule\Repositories;
 */
class ModuleRepository extends BaseRepository implements ModuleInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Module::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return ModuleValidator::class;
    }
    /**
     * @param Module $module
     * @return boolean;
     */
    public function allowDelete(Module $module)
    {
        return true;
    }
}
