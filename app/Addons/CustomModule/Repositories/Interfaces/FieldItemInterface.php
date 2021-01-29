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

namespace App\Addons\CustomModule\Repositories\Interfaces;


use App\Addons\CustomModule\Models\FieldItem;
use App\Repositories\BaseInterface;

interface FieldItemInterface extends BaseInterface
{
    /**
     * @param FieldItem $fieldItem
     * @return boolean;
     */
    public function allowDelete (FieldItem $fieldItem);
}
