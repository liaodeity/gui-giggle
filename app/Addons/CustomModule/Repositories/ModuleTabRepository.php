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

namespace App\Addons\CustomModule\Repositories;

use App\Addons\CustomModule\Models\ModuleTab;
use App\Addons\CustomModule\Repositories\Interfaces\ModuleTabInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomModule\Validators\ModuleTabValidator;
/**
 * Class ModuleTabRepository.
 * @package namespace App\Addons\CustomModule\Repositories;
 */
class ModuleTabRepository extends BaseRepository implements ModuleTabInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return ModuleTab::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return ModuleTabValidator::class;
    }
    /**
     * @param ModuleTab $moduleTab
     * @return boolean;
     */
    public function allowDelete(ModuleTab $moduleTab)
    {
        return true;
    }
}
