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


use App\Addons\CustomModule\Models\Module;
use League\Fractal\TransformerAbstract;

class ModuleTransformer extends TransformerAbstract
{
    public function transform (Module $module)
    {
        return [
            'id' => $module->id,
			'name' => $module->name,
			'created_at' => $module->created_at ? $module->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $module->updated_at ? $module->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/module/' . $module->id),
            '_edit_url'  => url ('admin/module/' . $module->id . '/edit'),
            '_delete_url'  => url ('admin/module/' . $module->id . '/edit'),
            '_batch_delete' => url ('admin/module/delete/batch')
        ];
    }
}
