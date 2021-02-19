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
namespace App\Addons\Parameter\Transformers;



use App\Addons\Parameter\Models\Parameter;
use League\Fractal\TransformerAbstract;

class ParameterTransformer extends TransformerAbstract
{
    public function transform (Parameter $parameter)
    {
        return [
            'id' => $parameter->id,
			'name' => $parameter->name,
			'model' => $parameter->model,
			'title' => $parameter->title,
			'created_at' => $parameter->created_at ? $parameter->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $parameter->updated_at ? $parameter->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/parameter/' . $parameter->id),
            '_edit_url'  => url ('admin/parameter/' . $parameter->id . '/edit'),
            '_delete_url'  => url ('admin/parameter/' . $parameter->id . '/edit'),
            '_batch_delete' => url ('admin/parameter/delete/batch')
        ];
    }
}
