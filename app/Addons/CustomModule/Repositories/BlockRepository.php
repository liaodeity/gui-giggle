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

use App\Addons\CustomModule\Models\Block;
use App\Addons\CustomModule\Repositories\Interfaces\BlockInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomModule\Validators\BlockValidator;
/**
 * Class BlockRepository.
 * @package namespace App\Addons\CustomModule\Repositories;
 */
class BlockRepository extends BaseRepository implements BlockInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Block::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return BlockValidator::class;
    }
    /**
     * @param Block $block
     * @return boolean;
     */
    public function allowDelete(Block $block)
    {
        return true;
    }
}
