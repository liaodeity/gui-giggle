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
namespace App\Addons\Parameter\Models;

use App\Models\BaseModel;


class ParameterItem extends BaseModel
{


    protected $table = 'parameter_items';

    protected $fillable = ['parameter_id','key','item','status','color','sort','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];


    /**
     * 键 add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function keyItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'key', $ind, $html);
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
