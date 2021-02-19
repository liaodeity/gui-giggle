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
namespace App\Traits;



use App\Addons\User\Models\User;

trait BelongsToUser
{
    /**.
     *  add by gui
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @return mixed
     */
    public function user ()
    {
        return $this->belongsTo (User::class);
    }
}
