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
namespace App\Addons\Config\Validators;

use App\Validators\LiaoValidator;

/**
 * Class ConfigValidator.
 * @package namespace App\Validators\Admin;
 */
class ConfigValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            'context'=>'required'
        ],
        self::RULE_UPDATE => [
            'context'=>'required'
        ],
    ];
    protected $attributes = [
        'context'=>'配置内容'
    ];
}
