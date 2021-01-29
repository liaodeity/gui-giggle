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

namespace App\Addons\CustomView\Repositories;

use App\Addons\CustomView\Models\CustomViewField;
use App\Addons\CustomView\Repositories\Interfaces\CustomViewFieldInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomView\Validators\CustomViewFieldValidator;
/**
 * Class CustomViewFieldRepository.
 * @package namespace App\Addons\CustomView\Repositories;
 */
class CustomViewFieldRepository extends BaseRepository implements CustomViewFieldInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return CustomViewField::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return CustomViewFieldValidator::class;
    }
    /**
     * @param CustomViewField $customViewField
     * @return boolean;
     */
    public function allowDelete(CustomViewField $customViewField)
    {
        return true;
    }
}
