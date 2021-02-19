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

namespace App\Addons\CustomView\Repositories;

use App\Addons\CustomView\Models\CustomViewCondition;
use App\Addons\CustomView\Repositories\Interfaces\CustomViewConditionInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomView\Validators\CustomViewConditionValidator;
/**
 * Class CustomViewConditionRepository.
 * @package namespace App\Addons\CustomView\Repositories;
 */
class CustomViewConditionRepository extends BaseRepository implements CustomViewConditionInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return CustomViewCondition::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return CustomViewConditionValidator::class;
    }
    /**
     * @param CustomViewCondition $customViewCondition
     * @return boolean;
     */
    public function allowDelete(CustomViewCondition $customViewCondition)
    {
        return true;
    }
}
