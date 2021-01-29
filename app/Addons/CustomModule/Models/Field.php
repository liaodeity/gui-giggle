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
namespace App\Addons\CustomModule\Models;

use App\Models\BaseModel;


class Field extends BaseModel
{


    protected $table = 'fields';

    protected $fillable = ['tab_id','tab_name', 'field_name','title','type','max_length','default_value','is_nullable','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];



}
