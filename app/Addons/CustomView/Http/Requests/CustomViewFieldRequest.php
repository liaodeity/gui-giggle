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

namespace App\Addons\CustomView\Http\Requests;


use App\Http\Requests\AddonsRequest;
use Illuminate\Foundation\Http\FormRequest;

class CustomViewFieldRequest extends AddonsRequest
{

    public function getFillData ()
    {
        $data = $this->input ('CustomViewField');

        return $data;
    }
}
