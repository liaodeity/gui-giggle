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
 * Class ModuleTabValidator.
 * @package Addons\CustomModule\Validators;
 */
class ModuleTabValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'module_id'=>'required',
			// 'tab_id'=>'required',
			// 'foreign_tab_id'=>'required',
			'joiner'=>'required',
			'sort'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'module_id'=>'required',
			// 'tab_id'=>'required',
			// 'foreign_tab_id'=>'required',
			'joiner'=>'required',
			'sort'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'module_id'=>'MODULE_ID',
		'tab_id'=>'表ID',
		'foreign_tab_id'=>'外键表ID',
		'joiner'=>'连接符',
		'sort'=>'排序',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
