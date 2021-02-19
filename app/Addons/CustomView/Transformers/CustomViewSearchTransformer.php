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


use App\Addons\CustomView\Models\CustomViewSearch;
use League\Fractal\TransformerAbstract;

class CustomViewSearchTransformer extends TransformerAbstract
{
    public function transform (CustomViewSearch $customViewSearch)
    {
        return [
            'id' => $customViewSearch->id,
			'custom_view_id' => $customViewSearch->custom_view_id,
			'field_id' => $customViewSearch->field_id,
			'sort' => $customViewSearch->sort,
			'_is_hide' => $customViewSearch->isHideItem($customViewSearch->is_hide),
			'is_hide' => $customViewSearch->is_hide,
			'created_at' => $customViewSearch->created_at ? $customViewSearch->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $customViewSearch->updated_at ? $customViewSearch->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/custom_view_search/' . $customViewSearch->id),
            '_edit_url'  => url ('admin/custom_view_search/' . $customViewSearch->id . '/edit'),
            '_delete_url'  => url ('admin/custom_view_search/' . $customViewSearch->id . '/edit'),
            '_batch_delete' => url ('admin/custom_view_search/delete/batch')
        ];
    }
}
