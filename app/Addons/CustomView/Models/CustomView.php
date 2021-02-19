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


class CustomView extends BaseModel
{


    protected $table = 'custom_views';

    protected $fillable = ['module_id','name','title','is_default','status','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];


    /**
     * 是否默认视图 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isDefaultItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_default', $ind, $html);
    }

    /**
     * 状态[1=正常,2=隐藏] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function statusItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'status', $ind, $html);
    }


}
