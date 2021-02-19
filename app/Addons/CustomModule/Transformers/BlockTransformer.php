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

namespace App\Addons\CustomModule\Transformers;


use App\Addons\CustomModule\Models\Block;
use League\Fractal\TransformerAbstract;

class BlockTransformer extends TransformerAbstract
{
    public function transform (Block $block)
    {
        return [
            'id' => $block->id,
			'module_id' => $block->module_id,
			'name' => $block->name,
			'created_at' => $block->created_at ? $block->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $block->updated_at ? $block->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/block/' . $block->id),
            '_edit_url'  => url ('admin/block/' . $block->id . '/edit'),
            '_delete_url'  => url ('admin/block/' . $block->id . '/edit'),
            '_batch_delete' => url ('admin/block/delete/batch')
        ];
    }
}
