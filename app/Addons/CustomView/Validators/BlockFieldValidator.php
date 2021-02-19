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
 * Class BlockFieldValidator.
 * @package Addons\CustomView\Validators;
 */
class BlockFieldValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'block_id'=>'required',
			// 'field_id'=>'required',
			'typeof_data'=>'required',
			// 'is_hidden'=>'required',
			// 'is_create'=>'required',
			// 'is_quick_create'=>'required',
			// 'is_edit'=>'required',
			// 'is_view'=>'required',
			// 'is_require'=>'required',
			// 'is_foreign_key'=>'required',
			// 'ui_type'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'block_id'=>'required',
			// 'field_id'=>'required',
			'typeof_data'=>'required',
			// 'is_hidden'=>'required',
			// 'is_create'=>'required',
			// 'is_quick_create'=>'required',
			// 'is_edit'=>'required',
			// 'is_view'=>'required',
			// 'is_require'=>'required',
			// 'is_foreign_key'=>'required',
			// 'ui_type'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'block_id'=>'视图块ID',
		'field_id'=>'字段ID',
		'typeof_data'=>'数据类型',
		'is_hidden'=>'是否隐藏字段',
		'is_create'=>'是否允许创建',
		'is_quick_create'=>'是否允许快速创建',
		'is_edit'=>'是否允许修改',
		'is_view'=>'是否允许查看',
		'is_require'=>'是否必填',
		'is_foreign_key'=>'是否关键外键字段',
		'ui_type'=>'视图显示类型',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
