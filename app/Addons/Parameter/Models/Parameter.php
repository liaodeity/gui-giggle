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
namespace App\Addons\Parameter\Models;

use App\Models\BaseModel;


class Parameter extends BaseModel
{


    protected $table = 'parameters';

    protected $fillable = ['name','model','title','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];

    public function parameterItems ()
    {
        return $this->hasMany (ParameterItem::class);
    }

}
