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
namespace App\Addons\CustomView\Models;

use App\Models\BaseModel;


class CustomViewCondition extends BaseModel
{


    protected $table = 'custom_view_conditions';

    protected $fillable = ['custom_view_id','field_id','group_type','type','comparator','data_value','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];



}
