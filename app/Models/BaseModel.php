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

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model
{
    //public $incrementing = false;
    //
    ///**
    // *  Setup model event hooks
    // */
    //public static function boot()
    //{
    //    parent::boot ();
    //    self::creating (function ($model) {
    //        if (is_null ($model->id) && $model->getIncrementing() === false) {
    //            $model->id = get_uuid ();
    //        }
    //    });
    //}
}
