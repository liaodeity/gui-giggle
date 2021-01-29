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

namespace App\Addons\CustomModule\Transformers;


use App\Addons\CustomModule\Models\FieldItem;
use League\Fractal\TransformerAbstract;

class FieldItemTransformer extends TransformerAbstract
{
    public function transform (FieldItem $fieldItem)
    {
        return [
            'id' => $fieldItem->id,
			'field_id' => $fieldItem->field_id,
			'_value' => $fieldItem->valueItem($fieldItem->value),
			'value' => $fieldItem->value,
			'label' => $fieldItem->label,
			'_status' => $fieldItem->statusItem($fieldItem->status),
			'status' => $fieldItem->status,
			'color' => $fieldItem->color,
			'sort' => $fieldItem->sort,
			'created_at' => $fieldItem->created_at ? $fieldItem->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $fieldItem->updated_at ? $fieldItem->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/field_item/' . $fieldItem->id),
            '_edit_url'  => url ('admin/field_item/' . $fieldItem->id . '/edit'),
            '_delete_url'  => url ('admin/field_item/' . $fieldItem->id . '/edit'),
            '_batch_delete' => url ('admin/field_item/delete/batch')
        ];
    }
}
