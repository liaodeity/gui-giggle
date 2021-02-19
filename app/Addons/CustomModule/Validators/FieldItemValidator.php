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
namespace App\Addons\CustomModule\Validators;

use App\Validators\LiaoValidator;

/**
 * Class FieldItemValidator.
 * @package Addons\CustomModule\Validators;
 */
class FieldItemValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'field_id'=>'required',
			// 'value'=>'required',
			'label'=>'required',
			// 'status'=>'required',
			'color'=>'required',
			'sort'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'field_id'=>'required',
			// 'value'=>'required',
			'label'=>'required',
			// 'status'=>'required',
			'color'=>'required',
			'sort'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'field_id'=>'FIELD_ID',
		'value'=>'键值',
		'label'=>'名称',
		'status'=>'状态',
		'color'=>'颜色',
		'sort'=>'排序',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
