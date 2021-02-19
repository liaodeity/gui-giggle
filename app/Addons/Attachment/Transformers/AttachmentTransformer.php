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

namespace App\Addons\Attachment\Transformers;


use App\Addons\Attachment\Models\Attachment;
use League\Fractal\TransformerAbstract;

class AttachmentTransformer extends TransformerAbstract
{
    public function transform (Attachment $attachment)
    {
        return [
            'id' => $attachment->id,
			'uuid' => $attachment->uuid,
			'path' => $attachment->path,
			'title' => $attachment->title,
			'md5' => $attachment->md5,
			'sha1' => $attachment->sha1,
			'mine_type' => $attachment->mine_type,
			'suffix' => $attachment->suffix,
			'size' => $attachment->size,
			'use_number' => $attachment->use_number,
			'last_at' => $attachment->last_at ? $attachment->last_at->format ('Y-m-d H:i:s') : null,
			'_status' => $attachment->statusItem($attachment->status),
			'status' => $attachment->status,
			'user_id' => $attachment->user_id,
			'deleted_at' => $attachment->deleted_at ? $attachment->deleted_at->format ('Y-m-d H:i:s') : null,
			'created_at' => $attachment->created_at ? $attachment->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $attachment->updated_at ? $attachment->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/attachment/' . $attachment->id),
            '_edit_url'  => url ('admin/attachment/' . $attachment->id . '/edit'),
            '_delete_url'  => url ('admin/attachment/' . $attachment->id . '/edit'),
            '_batch_delete' => url ('admin/attachment/delete/batch')
        ];
    }
}
