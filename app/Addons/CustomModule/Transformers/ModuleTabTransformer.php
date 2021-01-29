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


use App\Addons\CustomModule\Models\ModuleTab;
use League\Fractal\TransformerAbstract;

class ModuleTabTransformer extends TransformerAbstract
{
    public function transform (ModuleTab $moduleTab)
    {
        return [
            'id' => $moduleTab->id,
			'module_id' => $moduleTab->module_id,
			'tab_id' => $moduleTab->tab_id,
			'foreign_tab_id' => $moduleTab->foreign_tab_id,
			'joiner' => $moduleTab->joiner,
			'sort' => $moduleTab->sort,
			'created_at' => $moduleTab->created_at ? $moduleTab->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $moduleTab->updated_at ? $moduleTab->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/module_tab/' . $moduleTab->id),
            '_edit_url'  => url ('admin/module_tab/' . $moduleTab->id . '/edit'),
            '_delete_url'  => url ('admin/module_tab/' . $moduleTab->id . '/edit'),
            '_batch_delete' => url ('admin/module_tab/delete/batch')
        ];
    }
}
