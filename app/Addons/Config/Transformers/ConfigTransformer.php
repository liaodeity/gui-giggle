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

namespace App\Addons\Config\Transformers;


use App\Addons\Config\Models\Config;
use League\Fractal\TransformerAbstract;

class ConfigTransformer extends TransformerAbstract
{
    public function transform (Config $config)
    {
        return [
            'id'         => $config->id,
            'context'    => $config->getContextValue ($config),
            'name'       => $config->name,
            'title'      => $config->title,
            'type'       => $config->type,
            '_type'      => $config->typeItem ($config->type),
            'created_at' => $config->created_at->format ('Y-m-d H:i:s'),
            '_show_url'  => url ('admin/config/' . $config->id),
            '_edit_url'  => url ('admin/config/' . $config->id . '/edit'),
            '_delete_url'  => $config->type == 1 ? url ('admin/config/' . $config->id . '/edit') : '',
            '_batch_delete' => url ('admin/config/delete/batch')
        ];
    }
}
