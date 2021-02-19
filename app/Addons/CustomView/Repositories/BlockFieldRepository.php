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

use App\Addons\CustomView\Models\BlockField;
use App\Addons\CustomView\Repositories\Interfaces\BlockFieldInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomView\Validators\BlockFieldValidator;
/**
 * Class BlockFieldRepository.
 * @package namespace App\Addons\CustomView\Repositories;
 */
class BlockFieldRepository extends BaseRepository implements BlockFieldInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return BlockField::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return BlockFieldValidator::class;
    }
    /**
     * @param BlockField $blockField
     * @return boolean;
     */
    public function allowDelete(BlockField $blockField)
    {
        return true;
    }
}
