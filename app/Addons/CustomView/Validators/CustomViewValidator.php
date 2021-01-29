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
namespace App\Addons\CustomView\Validators;

use App\Validators\LiaoValidator;

/**
 * Class CustomViewValidator.
 * @package Addons\CustomView\Validators;
 */
class CustomViewValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            'name'=>'required',
			'title'=>'required',
			// 'is_default'=>'required',
			// 'status'=>'required',

        ],
        self::RULE_UPDATE => [
            'name'=>'required',
			'title'=>'required',
			// 'is_default'=>'required',
			// 'status'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'name'=>'自定义视图',
		'title'=>'自定义视图标题',
		'is_default'=>'是否默认视图',
		'status'=>'状态',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
