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
namespace App\Addons\Menu\Validators;

use App\Validators\LiaoValidator;

/**
 * Class MenuValidator.
 * @package namespace App\Validators\SystemGui;
 */
class MenuValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'pid'=>'required',
			'menu_name'=>'required',
			'auth_name'=>'required',
			// 'module'=>'required',
			// 'type'=>'required',
			'sort'=>'required',
			'route_url'=>'required',
			'title'=>'required',
			'icon'=>'required',
			// 'status'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'pid'=>'required',
			'menu_name'=>'required',
			'auth_name'=>'required',
			// 'module'=>'required',
			// 'type'=>'required',
			'sort'=>'required',
			'route_url'=>'required',
			'title'=>'required',
			'icon'=>'required',
			// 'status'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'pid'=>'父ID',
		'menu_name'=>'菜单标识名称',
		'auth_name'=>'权限名称',
		'module'=>'所属模块',
		'type'=>'类型',
		'sort'=>'排序',
		'route_url'=>'路由地址',
		'title'=>'菜单名称',
		'icon'=>'图标',
		'status'=>'状态',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
