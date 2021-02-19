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

namespace App\Addons\Login\Transformers;


use App\Addons\Login\Models\Login;
use League\Fractal\TransformerAbstract;

class LoginTransformer extends TransformerAbstract
{
    public function transform (Login $login)
    {
        return [

            '_show_url'  => url ('admin/login/' . $login->id),
            '_edit_url'  => url ('admin/login/' . $login->id . '/edit'),
            '_delete_url'  => url ('admin/login/' . $login->id . '/edit'),
            '_batch_delete' => url ('admin/login/delete/batch')
        ];
    }
}
