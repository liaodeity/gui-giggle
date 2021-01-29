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

namespace App\Addons\CustomView\Transformers;


use App\Addons\CustomView\Models\CustomViewField;
use League\Fractal\TransformerAbstract;

class CustomViewFieldTransformer extends TransformerAbstract
{
    public function transform (CustomViewField $customViewField)
    {
        return [
            'id' => $customViewField->id,
			'custom_view_id' => $customViewField->custom_view_id,
			'field_id' => $customViewField->field_id,
			'_is_hide' => $customViewField->isHideItem($customViewField->is_hide),
			'is_hide' => $customViewField->is_hide,
			'sort' => $customViewField->sort,
			'created_at' => $customViewField->created_at ? $customViewField->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $customViewField->updated_at ? $customViewField->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/custom_view_field/' . $customViewField->id),
            '_edit_url'  => url ('admin/custom_view_field/' . $customViewField->id . '/edit'),
            '_delete_url'  => url ('admin/custom_view_field/' . $customViewField->id . '/edit'),
            '_batch_delete' => url ('admin/custom_view_field/delete/batch')
        ];
    }
}
