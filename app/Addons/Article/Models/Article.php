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
namespace App\Addons\Article\Models;

use App\Models\BaseModel;
use App\Traits\BelongsToUser;


class Article extends BaseModel
{
    use BelongsToUser;

    protected $table = 'articles';

    protected $fillable = ['category_id','title','cover_id','sub_title','source','source_link','view_number','is_top','description','content','release_at','user_id','status','created_at','updated_at'];

    protected $dates = ['release_at','created_at','updated_at'];


    /**
     * 是否置顶[1=是,0=否] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isTopItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_top', $ind, $html);
    }

    /**
     * 状态[1=显示,2=草稿,4=隐藏] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function statusItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'status', $ind, $html);
    }


}
