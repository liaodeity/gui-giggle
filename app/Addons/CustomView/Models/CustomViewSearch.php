<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( MIT )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: Gui < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/
namespace App\Addons\CustomView\Models;

use App\Models\BaseModel;


class CustomViewSearch extends BaseModel
{


    protected $table = 'custom_view_searches';

    protected $fillable = ['custom_view_id','field_id','sort','is_hide','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];


    /**
     * 是否隐藏字段 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isHideItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_hide', $ind, $html);
    }


}
