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
namespace App\Addons\Parameter\Repositories;

use App\Addons\Parameter\Models\ParameterItem;
use App\Addons\Parameter\Repositories\Interfaces\ParameterItemInterface;
use App\Addons\Plugin\Validators\ParameterItemValidator;
use App\Repositories\BaseInterface;
use App\Repositories\BaseRepository;
/**
 * Class ParameterItemRepository.
 * @package namespace App\Repositories\Parameter;
 */
class ParameterItemRepository extends BaseRepository implements ParameterItemInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return ParameterItem::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return ParameterItemValidator::class;
    }
    /**
     * @param ParameterItem $parameterItem
     * @return boolean;
     */
    public function allowDelete(ParameterItem $parameterItem)
    {
        return true;
    }
}
