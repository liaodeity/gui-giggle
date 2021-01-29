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
namespace App\Addons\Parameter\Transformers;


use App\Addons\Parameter\Models\ParameterItem;
use League\Fractal\TransformerAbstract;

class ParameterItemTransformer extends TransformerAbstract
{
    public function transform (ParameterItem $parameterItem)
    {
        return [
            'id' => $parameterItem->id,
			'parameter_id' => $parameterItem->parameter_id,
			'_key' => $parameterItem->keyItem($parameterItem->key),
			'key' => $parameterItem->key,
			'item' => $parameterItem->item,
			'_status' => $parameterItem->statusItem($parameterItem->status),
			'status' => $parameterItem->status,
			'color' => $parameterItem->color,
			'sort' => $parameterItem->sort,
			'created_at' => $parameterItem->created_at ? $parameterItem->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $parameterItem->updated_at ? $parameterItem->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/parameter_item/' . $parameterItem->id),
            '_edit_url'  => url ('admin/parameter_item/' . $parameterItem->id . '/edit'),
            '_delete_url'  => url ('admin/parameter_item/' . $parameterItem->id . '/edit'),
            '_batch_delete' => url ('admin/parameter_item/delete/batch')
        ];
    }
}
