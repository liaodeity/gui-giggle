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

namespace App\Addons\Article\Repositories\Interfaces;


use App\Addons\Article\Models\Article;
use App\Repositories\BaseInterface;

interface ArticleInterface extends BaseInterface
{
    /**
     * @param Article $article
     * @return boolean;
     */
    public function allowDelete (Article $article);
}
