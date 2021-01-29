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
namespace App\Addons\Article\Models;

use App\Models\BaseModel;
use App\Traits\BelongsToUser;


class ArticleRead extends BaseModel
{
    use BelongsToUser;

    protected $table = 'article_reads';

    protected $fillable = ['article_id','view_at','user_id','created_at','updated_at'];

    protected $dates = ['view_at','created_at','updated_at'];



}
