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


use App\Addons\CustomModule\Models\Tab;
use League\Fractal\TransformerAbstract;

class TabTransformer extends TransformerAbstract
{
    public function transform (Tab $tab)
    {
        return [
            'id' => $tab->id,
			'name' => $tab->name,
			'title' => $tab->title,
			'created_at' => $tab->created_at ? $tab->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $tab->updated_at ? $tab->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/tab/' . $tab->id),
            '_edit_url'  => url ('admin/tab/' . $tab->id . '/edit'),
            '_delete_url'  => url ('admin/tab/' . $tab->id . '/edit'),
            '_batch_delete' => url ('admin/tab/delete/batch')
        ];
    }
}
