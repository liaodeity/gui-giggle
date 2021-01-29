<?php

namespace App\Addons\User\Validators;

use App\Validators\LiaoValidator;

/**
 * Class AdminValidator.
 * @package namespace App\Validators\SystemGui;
 */
class AdminValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules      = [
        self::RULE_CREATE => [
            'username' => 'required|unique:user_admins',
            'password' => 'required',
            'status'   => 'required',

        ],
        self::RULE_UPDATE => [
            'username' => 'required|unique:user_admins',
            //'password'=>'required',
            'status'   => 'required',

        ],
    ];
    protected $attributes = [
        'id'         => '编号',
        'user_id'    => '所属用户',
        'username'   => '账号名称',
        'password'   => '密码',
        'status'     => '状态',
        'created_at' => '创建时间',
        'updated_at' => '更新时间',

    ];
}
