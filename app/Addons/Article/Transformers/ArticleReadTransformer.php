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
namespace App\Addons\Article\Transformers;


use App\Addons\Article\Models\ArticleRead;
use League\Fractal\TransformerAbstract;

class ArticleReadTransformer extends TransformerAbstract
{
    public function transform (ArticleRead $articleRead)
    {
        return [
            'id' => $articleRead->id,
			'article_id' => $articleRead->article_id,
			'view_at' => $articleRead->view_at ? $articleRead->view_at->format ('Y-m-d H:i:s') : null,
			'user_id' => $articleRead->user_id,
			'created_at' => $articleRead->created_at ? $articleRead->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $articleRead->updated_at ? $articleRead->updated_at->format ('Y-m-d H:i:s') : null,

        ];
    }
}
