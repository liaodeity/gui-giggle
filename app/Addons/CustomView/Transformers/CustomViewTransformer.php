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


use App\Addons\CustomView\Models\CustomView;
use League\Fractal\TransformerAbstract;

class CustomViewTransformer extends TransformerAbstract
{
    public function transform (CustomView $customView)
    {
        return [
            'id' => $customView->id,
			'name' => $customView->name,
			'title' => $customView->title,
			'_is_default' => $customView->isDefaultItem($customView->is_default),
			'is_default' => $customView->is_default,
			'_status' => $customView->statusItem($customView->status),
			'status' => $customView->status,
			'created_at' => $customView->created_at ? $customView->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $customView->updated_at ? $customView->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/custom_view/' . $customView->id),
            '_edit_url'  => url ('admin/custom_view/' . $customView->id . '/edit'),
            '_delete_url'  => url ('admin/custom_view/' . $customView->id . '/edit'),
            '_batch_delete' => url ('admin/custom_view/delete/batch')
        ];
    }
}
