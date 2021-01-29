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
namespace App\Addons\Plugin\Validators;

use App\Validators\LiaoValidator;

/**
 * Class ParameterItemValidator.
 * @package namespace App\Validators\Parameter;
 */
class ParameterItemValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'parameter_id'=>'required',
			// 'key'=>'required',
			'item'=>'required',
			// 'status'=>'required',
			'color'=>'required',
			'sort'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'parameter_id'=>'required',
			// 'key'=>'required',
			'item'=>'required',
			// 'status'=>'required',
			'color'=>'required',
			'sort'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'parameter_id'=>'PARAMETER_ID',
		'key'=>'键',
		'item'=>'名称',
		'status'=>'状态',
		'color'=>'颜色',
		'sort'=>'排序',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
