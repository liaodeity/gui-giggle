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

namespace App\Addons\CustomView\Transformers;


use App\Addons\CustomView\Models\CustomViewCondition;
use League\Fractal\TransformerAbstract;

class CustomViewConditionTransformer extends TransformerAbstract
{
    public function transform (CustomViewCondition $customViewCondition)
    {
        return [
            'id' => $customViewCondition->id,
			'custom_view_id' => $customViewCondition->custom_view_id,
			'field_id' => $customViewCondition->field_id,
			'group_type' => $customViewCondition->group_type,
			'type' => $customViewCondition->type,
			'comparator' => $customViewCondition->comparator,
			'data_value' => $customViewCondition->data_value,
			'created_at' => $customViewCondition->created_at ? $customViewCondition->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $customViewCondition->updated_at ? $customViewCondition->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/custom_view_condition/' . $customViewCondition->id),
            '_edit_url'  => url ('admin/custom_view_condition/' . $customViewCondition->id . '/edit'),
            '_delete_url'  => url ('admin/custom_view_condition/' . $customViewCondition->id . '/edit'),
            '_batch_delete' => url ('admin/custom_view_condition/delete/batch')
        ];
    }
}
