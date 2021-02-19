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

namespace App\Addons\PublicImage\Transformers;


use App\Addons\PublicImage\Models\Image;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{
    public function transform (Image $image)
    {
        return [

            '_show_url'  => url ('admin/image/' . $image->id),
            '_edit_url'  => url ('admin/image/' . $image->id . '/edit'),
            '_delete_url'  => url ('admin/image/' . $image->id . '/edit'),
            '_batch_delete' => url ('admin/image/delete/batch')
        ];
    }
}
