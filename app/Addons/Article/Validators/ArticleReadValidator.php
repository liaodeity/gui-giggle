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
namespace App\Addons\Article\Validators;

use App\Validators\LiaoValidator;

/**
 * Class ArticleReadValidator.
 * @package namespace App\Validators\Article;
 */
class ArticleReadValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'article_id'=>'required',
			// 'view_at'=>'required',
			// 'user_id'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'article_id'=>'required',
			// 'view_at'=>'required',
			// 'user_id'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'article_id'=>'文章编号',
		'view_at'=>'浏览时间',
		'user_id'=>'浏览人',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
