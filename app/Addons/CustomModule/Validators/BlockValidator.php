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
 * Class BlockValidator.
 * @package Addons\CustomModule\Validators;
 */
class BlockValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'module_id'=>'required',
			'name'=>'required',
			
        ],
        self::RULE_UPDATE => [
            // 'module_id'=>'required',
			'name'=>'required',
			
        ],
    ];
    protected $attributes = [
        'id'=>'块ID',
		'module_id'=>'MODULE_ID',
		'name'=>'视图块名称',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',
		
    ];
}
