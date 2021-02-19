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
namespace App\Addons\CustomView\Validators;

use App\Validators\LiaoValidator;

/**
 * Class CustomViewFieldValidator.
 * @package Addons\CustomView\Validators;
 */
class CustomViewFieldValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'custom_view_id'=>'required',
			// 'field_id'=>'required',
			// 'is_hide'=>'required',
			'sort'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'custom_view_id'=>'required',
			// 'field_id'=>'required',
			// 'is_hide'=>'required',
			'sort'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'custom_view_id'=>'自定义视图ID',
		'field_id'=>'字段ID',
		'is_hide'=>'是否隐藏',
		'sort'=>'排序',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
