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
 * Class ModuleValidator.
 * @package Addons\CustomModule\Validators;
 */
class ModuleValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            'name'=>'required',

        ],
        self::RULE_UPDATE => [
            'name'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'name'=>'模块名称',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
