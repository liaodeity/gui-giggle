<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( MIT )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: 廖春贵 < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/
namespace App\Addons\Article\Validators;

use App\Validators\LiaoValidator;

/**
 * Class ArticleValidator.
 * @package Addons\Article\Validators;
 */
class ArticleValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'category_id'=>'required',
			'title'=>'required',
			// 'cover_id'=>'required',
			'sub_title'=>'required',
			'source'=>'required',
			'source_link'=>'required',
			'view_number'=>'required',
			// 'is_top'=>'required',
			'description'=>'required',
			'content'=>'required',
			// 'release_at'=>'required',
			// 'user_id'=>'required',
			// 'status'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'category_id'=>'required',
			'title'=>'required',
			// 'cover_id'=>'required',
			'sub_title'=>'required',
			'source'=>'required',
			'source_link'=>'required',
			'view_number'=>'required',
			// 'is_top'=>'required',
			'description'=>'required',
			'content'=>'required',
			// 'release_at'=>'required',
			// 'user_id'=>'required',
			// 'status'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'category_id'=>'所属分类',
		'title'=>'标题',
		'cover_id'=>'封面图片',
		'sub_title'=>'副标题',
		'source'=>'来源名称',
		'source_link'=>'来源地址',
		'view_number'=>'浏览次数',
		'is_top'=>'是否置顶',
		'description'=>'简要描述',
		'content'=>'内容',
		'release_at'=>'发布时间',
		'user_id'=>'发布人',
		'status'=>'状态',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
