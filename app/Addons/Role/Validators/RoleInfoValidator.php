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
namespace App\Addons\Role\Validators;

use App\Validators\LiaoValidator;

/**
 * Class RoleInfoValidator.
 * @package namespace App\Validators\Role;
 */
class RoleInfoValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'role_id'=>'required',
			'name'=>'required',
			'desc'=>'required',
			'role_value'=>'required',
			// 'status'=>'required',
			// 'user_id'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'role_id'=>'required',
			'name'=>'required',
			'desc'=>'required',
			'role_value'=>'required',
			// 'status'=>'required',
			// 'user_id'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'role_id'=>'角色id',
		'name'=>'角色名称',
		'desc'=>'角色说明',
		'role_value'=>'权限ID',
		'status'=>'状态',
		'user_id'=>'创建人',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
