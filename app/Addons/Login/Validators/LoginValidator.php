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
namespace App\Addons\Login\Validators;

use App\Validators\LiaoValidator;

/**
 * Class LoginValidator.
 * @package Addons\Login\Validators;
 */
class LoginValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [

        ],
        self::RULE_UPDATE => [

        ],
    ];
    protected $attributes = [

    ];
}
