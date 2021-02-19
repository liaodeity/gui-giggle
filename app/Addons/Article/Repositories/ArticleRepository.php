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

namespace App\Addons\Article\Repositories;

use App\Addons\Article\Models\Article;
use App\Addons\Article\Repositories\Interfaces\ArticleInterface;
use App\Repositories\BaseRepository;
use App\Addons\Article\Validators\ArticleValidator;
/**
 * Class ArticleRepository.
 * @package namespace App\Addons\Article\Repositories;
 */
class ArticleRepository extends BaseRepository implements ArticleInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Article::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return ArticleValidator::class;
    }
    /**
     * @param Article $article
     * @return boolean;
     */
    public function allowDelete(Article $article)
    {
        return true;
    }
}
