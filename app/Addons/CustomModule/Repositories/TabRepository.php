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

use App\Addons\CustomModule\Models\Tab;
use App\Addons\CustomModule\Repositories\Interfaces\TabInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomModule\Validators\TabValidator;
/**
 * Class TabRepository.
 * @package namespace App\Addons\CustomModule\Repositories;
 */
class TabRepository extends BaseRepository implements TabInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Tab::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return TabValidator::class;
    }
    /**
     * @param Tab $tab
     * @return boolean;
     */
    public function allowDelete(Tab $tab)
    {
        return true;
    }
}
