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
namespace App\Addons\Article\Repositories;

use App\Addons\Article\Models\ArticleRead;
use App\Addons\Article\Repositories\Interfaces\ArticleReadInterface;
use App\Addons\Article\Validators\ArticleReadValidator;
use App\Repositories\BaseRepository;
/**
 * Class ArticleReadRepository.
 * @package namespace App\Repositories\Article;
 */
class ArticleReadRepository extends BaseRepository implements ArticleReadInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return ArticleRead::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return ArticleReadValidator::class;
    }
    /**
     * @param ArticleRead $articleRead
     * @return boolean;
     */
    public function allowDelete(ArticleRead $articleRead)
    {
        return true;
    }
}
