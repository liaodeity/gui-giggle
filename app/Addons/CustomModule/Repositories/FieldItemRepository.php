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

use App\Addons\CustomModule\Models\FieldItem;
use App\Addons\CustomModule\Repositories\Interfaces\FieldItemInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomModule\Validators\FieldItemValidator;
/**
 * Class FieldItemRepository.
 * @package namespace App\Addons\CustomModule\Repositories;
 */
class FieldItemRepository extends BaseRepository implements FieldItemInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return FieldItem::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return FieldItemValidator::class;
    }
    /**
     * @param FieldItem $fieldItem
     * @return boolean;
     */
    public function allowDelete(FieldItem $fieldItem)
    {
        return true;
    }
}
