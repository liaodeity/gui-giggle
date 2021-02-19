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

namespace App\Addons\CustomView\Transformers;


use App\Addons\CustomView\Models\BlockField;
use League\Fractal\TransformerAbstract;

class BlockFieldTransformer extends TransformerAbstract
{
    public function transform (BlockField $blockField)
    {
        return [
            'id' => $blockField->id,
			'block_id' => $blockField->block_id,
			'field_id' => $blockField->field_id,
			'typeof_data' => $blockField->typeof_data,
			'_is_hidden' => $blockField->isHiddenItem($blockField->is_hidden),
			'is_hidden' => $blockField->is_hidden,
			'_is_create' => $blockField->isCreateItem($blockField->is_create),
			'is_create' => $blockField->is_create,
			'_is_quick_create' => $blockField->isQuickCreateItem($blockField->is_quick_create),
			'is_quick_create' => $blockField->is_quick_create,
			'_is_edit' => $blockField->isEditItem($blockField->is_edit),
			'is_edit' => $blockField->is_edit,
			'_is_view' => $blockField->isViewItem($blockField->is_view),
			'is_view' => $blockField->is_view,
			'_is_require' => $blockField->isRequireItem($blockField->is_require),
			'is_require' => $blockField->is_require,
			'_is_foreign_key' => $blockField->isForeignKeyItem($blockField->is_foreign_key),
			'is_foreign_key' => $blockField->is_foreign_key,
			'_ui_type' => $blockField->uiTypeItem($blockField->ui_type),
			'ui_type' => $blockField->ui_type,
			'created_at' => $blockField->created_at ? $blockField->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $blockField->updated_at ? $blockField->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/block_field/' . $blockField->id),
            '_edit_url'  => url ('admin/block_field/' . $blockField->id . '/edit'),
            '_delete_url'  => url ('admin/block_field/' . $blockField->id . '/edit'),
            '_batch_delete' => url ('admin/block_field/delete/batch')
        ];
    }
}
