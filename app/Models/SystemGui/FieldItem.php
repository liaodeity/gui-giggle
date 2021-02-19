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
namespace App\Models\SystemGui;

use App\Models\BaseModel;


class FieldItem extends BaseModel
{


    protected $table = 'field_items';

    protected $fillable = ['field_id','value','label','status','color','sort','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];


    /**
     * 键值 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function valueItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'value', $ind, $html);
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
