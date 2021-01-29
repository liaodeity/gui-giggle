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
namespace App\Addons\CustomModule\Validators;

use App\Validators\LiaoValidator;

/**
 * Class FieldValidator.
 * @package Addons\CustomModule\Validators;
 */
class FieldValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'tab_id'=>'required',
			'name'=>'required',
			'title'=>'required',
			'type'=>'required',
			'max_length'=>'required',
			'default_value'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'tab_id'=>'required',
			'name'=>'required',
			'title'=>'required',
			'type'=>'required',
			'max_length'=>'required',
			'default_value'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'tab_id'=>'表ID',
		'name'=>'字段名称',
		'title'=>'字段中文名',
		'type'=>'字段类型',
		'max_length'=>'字段最大长度',
		'default_value'=>'DEFAULT_VALUE',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
