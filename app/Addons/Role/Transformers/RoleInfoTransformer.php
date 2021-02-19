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
namespace App\Addons\Role\Transformers;


use App\Addons\Role\Models\RoleInfo;
use League\Fractal\TransformerAbstract;

class RoleInfoTransformer extends TransformerAbstract
{
    public function transform (RoleInfo $roleInfo)
    {
        return [
            'id' => $roleInfo->id,
			'role_id' => $roleInfo->role_id,
			'name' => $roleInfo->name,
			'desc' => $roleInfo->desc,
			'role_value' => $roleInfo->role_value,
			'_status' => $roleInfo->statusItem($roleInfo->status),
			'status' => $roleInfo->status,
			'user_id' => $roleInfo->user_id,
			'created_at' => $roleInfo->created_at ? $roleInfo->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $roleInfo->updated_at ? $roleInfo->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/role_info/' . $roleInfo->id),
            '_edit_url'  => url ('admin/role_info/' . $roleInfo->id . '/edit'),
            '_delete_url'  => url ('admin/role_info/' . $roleInfo->id . '/edit'),
            '_batch_delete' => url ('admin/role_info/delete/batch')
        ];
    }
}
