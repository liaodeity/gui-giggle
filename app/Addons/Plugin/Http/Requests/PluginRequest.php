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
namespace App\Addons\Plugin\Http\Requests;


use App\Http\Requests\AddonsRequest;
use Illuminate\Foundation\Http\FormRequest;

class PluginRequest extends AddonsRequest
{

    public function getFillData ()
    {
        $data = $this->input ('Plugin');

        return $data;
    }
}
