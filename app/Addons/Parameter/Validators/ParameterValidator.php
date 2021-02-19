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
namespace App\Addons\Plugin\Validators;

use App\Validators\LiaoValidator;

/**
 * Class ParameterValidator.
 * @package namespace App\Validators\Parameter;
 */
class ParameterValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            'name'=>'required',
			'model'=>'required',
			'title'=>'required',

        ],
        self::RULE_UPDATE => [
            'name'=>'required',
			'model'=>'required',
			'title'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'name'=>'字段名称',
		'model'=>'所属模型',
		'title'=>'类型名称',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
