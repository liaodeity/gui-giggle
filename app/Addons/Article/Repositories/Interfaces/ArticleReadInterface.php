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
namespace App\Addons\Article\Repositories\Interfaces;


use App\Addons\Article\Models\ArticleRead;
use App\Repositories\BaseInterface;

interface ArticleReadInterface extends BaseInterface
{
    /**
     * @param ArticleRead $articleRead
     * @return boolean;
     */
    public function allowDelete (ArticleRead $articleRead);
}
