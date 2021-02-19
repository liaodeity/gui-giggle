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
namespace App\Addons\Plugin\Transformers;


use App\Addons\Plugin\Models\Plugin;
use League\Fractal\TransformerAbstract;

class PluginTransformer extends TransformerAbstract
{
    public function transform (Plugin $plugin)
    {
        return [
            'id' => $plugin->id,
			'name' => $plugin->name,
			'version' => $plugin->version,
			'title' => $plugin->title,
			'cover_img' => $plugin->cover_img,
			'content' => $plugin->content,
			'depend' => $plugin->depend,
			'file_tree' => $plugin->file_tree,
			'_is_install' => $plugin->isInstallItem($plugin->is_install),
			'is_install' => $plugin->is_install,
			'_is_update' => $plugin->isUpdateItem($plugin->is_update),
			'is_update' => $plugin->is_update,
			'install_at' => $plugin->install_at ? $plugin->install_at->format ('Y-m-d H:i:s') : null,
			'user_id' => $plugin->user_id,
			'deleted_at' => $plugin->deleted_at ? $plugin->deleted_at->format ('Y-m-d H:i:s') : null,
			'created_at' => $plugin->created_at ? $plugin->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $plugin->updated_at ? $plugin->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/plugin/' . $plugin->id),
            '_edit_url'  => url ('admin/plugin/' . $plugin->id . '/edit'),
            '_delete_url'  => url ('admin/plugin/' . $plugin->id . '/edit'),
            '_batch_delete' => url ('admin/plugin/delete/batch')
        ];
    }
}
