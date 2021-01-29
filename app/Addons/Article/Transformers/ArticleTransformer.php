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


use App\Addons\Article\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    public function transform (Article $article)
    {
        return [
            'id' => $article->id,
			'category_id' => $article->category_id,
			'title' => $article->title,
			'cover_id' => $article->cover_id,
			'sub_title' => $article->sub_title,
			'source' => $article->source,
			'source_link' => $article->source_link,
			'view_number' => $article->view_number,
			'_is_top' => $article->isTopItem($article->is_top),
			'is_top' => $article->is_top,
			'description' => $article->description,
			'content' => $article->content,
			'release_at' => $article->release_at ? $article->release_at->format ('Y-m-d H:i:s') : null,
			'user_id' => $article->user_id,
			'_status' => $article->statusItem($article->status),
			'status' => $article->status,
			'created_at' => $article->created_at ? $article->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $article->updated_at ? $article->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/article/' . $article->id),
            '_edit_url'  => url ('admin/article/' . $article->id . '/edit'),
            '_delete_url'  => url ('admin/article/' . $article->id . '/edit'),
            '_batch_delete' => url ('admin/article/delete/batch')
        ];
    }
}
