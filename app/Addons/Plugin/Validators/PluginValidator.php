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
 * Class PluginValidator.
 * @package namespace App\Validators\Plugin;
 */
class PluginValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'name'=>'required',
			'version'=>'required',
			'title'=>'required',
			'cover_img'=>'required',
			'content'=>'required',
			'depend'=>'required',
			'file_tree'=>'required',
			// 'is_install'=>'required',
			// 'is_update'=>'required',
			// 'install_at'=>'required',
			// 'user_id'=>'required',
			// 'deleted_at'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'name'=>'required',
			'version'=>'required',
			'title'=>'required',
			'cover_img'=>'required',
			'content'=>'required',
			'depend'=>'required',
			'file_tree'=>'required',
			// 'is_install'=>'required',
			// 'is_update'=>'required',
			// 'install_at'=>'required',
			// 'user_id'=>'required',
			// 'deleted_at'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'name'=>'插件标识',
		'version'=>'当前版本号',
		'title'=>'插件名称',
		'cover_img'=>'封面图片',
		'content'=>'插件详情',
		'depend'=>'依赖插件',
		'file_tree'=>'插件文件树',
		'is_install'=>'是否安装',
		'is_update'=>'是否更新',
		'install_at'=>'安装时间',
		'user_id'=>'修改人',
		'deleted_at'=>'DELETED_AT',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
