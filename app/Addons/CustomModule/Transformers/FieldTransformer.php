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


use App\Addons\CustomModule\Models\Field;
use League\Fractal\TransformerAbstract;

class FieldTransformer extends TransformerAbstract
{
    public function transform (Field $field)
    {
        return [
            'id' => $field->id,
			'tab_id' => $field->tab_id,
			'name' => $field->name,
			'title' => $field->title,
			'type' => $field->type,
			'max_length' => $field->max_length,
			'default_value' => $field->default_value,
			'created_at' => $field->created_at ? $field->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $field->updated_at ? $field->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/field/' . $field->id),
            '_edit_url'  => url ('admin/field/' . $field->id . '/edit'),
            '_delete_url'  => url ('admin/field/' . $field->id . '/edit'),
            '_batch_delete' => url ('admin/field/delete/batch')
        ];
    }
}
