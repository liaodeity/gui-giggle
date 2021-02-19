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
namespace App\Addons\CustomModule\Models;

use App\Models\BaseModel;


class ModuleTab extends BaseModel
{


    protected $table = 'module_tabs';

    protected $fillable = ['module_id','for_name','for_col_name','joiner','ref_col_name','ref_name','sort','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];



}
