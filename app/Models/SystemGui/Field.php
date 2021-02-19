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


class Field extends BaseModel
{


    protected $table = 'fields';

    protected $fillable = ['tab_id','tab_name', 'field_name','title','type','max_length','default_value','is_nullable','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];

    public function fieldItems ()
    {
        return $this->hasMany (FieldItem::class);
    }

}
