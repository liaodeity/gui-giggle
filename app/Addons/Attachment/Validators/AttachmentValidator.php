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
namespace App\Addons\Attachment\Validators;

use App\Validators\LiaoValidator;

/**
 * Class AttachmentValidator.
 * @package Addons\Attachment\Validators;
 */
class AttachmentValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'uuid'=>'required',
			'path'=>'required',
			'title'=>'required',
			'md5'=>'required',
			'sha1'=>'required',
			'mine_type'=>'required',
			'suffix'=>'required',
			'size'=>'required',
			// 'use_number'=>'required',
			// 'last_at'=>'required',
			// 'status'=>'required',
			// 'user_id'=>'required',
			// 'deleted_at'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'uuid'=>'required',
			'path'=>'required',
			'title'=>'required',
			'md5'=>'required',
			'sha1'=>'required',
			'mine_type'=>'required',
			'suffix'=>'required',
			'size'=>'required',
			// 'use_number'=>'required',
			// 'last_at'=>'required',
			// 'status'=>'required',
			// 'user_id'=>'required',
			// 'deleted_at'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'uuid'=>'附件唯一码',
		'path'=>'路径',
		'title'=>'名称',
		'md5'=>'MD5值',
		'sha1'=>'SHA1值',
		'mine_type'=>'文件类型',
		'suffix'=>'后缀名',
		'size'=>'附件大小byte',
		'use_number'=>'使用次数',
		'last_at'=>'最后使用时间',
		'status'=>'状态',
		'user_id'=>'上传人',
		'deleted_at'=>'DELETED_AT',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
