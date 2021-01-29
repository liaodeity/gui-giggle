<?php

namespace App\Addons\User\Validators;

use App\Validators\LiaoValidator;

/**
 * Class UserValidator.
 * @package namespace App\Validators\SystemGui;
 */
class UserValidator extends LiaoValidator
{
    const ADMIN_API_LOGIN  = 'admin_api_login';
    const RULE_ADMIN_LOGIN = 'admin_web_login';
    /**
     * Validation Rules
     * @var array
     */
    protected $rules      = [
        self::RULE_CREATE      => [
            'user_no'  => 'required',
            'mobile'   => 'required',
            'nickname' => 'required',
            'password' => 'required',
            'birthday' => 'required',
            'gender'   => 'required',
            'reg_date' => 'required',

        ],
        self::RULE_UPDATE      => [
            //'user_no'  => 'required',
            //'mobile'   => 'required',
            'nickname' => 'required',
            //'password' => 'required',
            //'birthday' => 'required',
            //'gender'   => 'required',
            //'reg_date' => 'required',

        ],
        self::ADMIN_API_LOGIN  => [
            'username' => 'required',
            'password' => 'required',
        ],
        self::RULE_ADMIN_LOGIN => [
            'username' => 'required',
            'password' => 'required',
            'captcha'  => 'required'
        ]
    ];
    protected $attributes = [
        'id'         => '编号',
        'user_no'    => '会员编号',
        'mobile'     => '会员手机号',
        'nickname'   => '昵称',
        'password'   => '密码',
        'birthday'   => '出生日期',
        'gender'     => '性别',
        'reg_date'   => '注册时间',
        'created_at' => '创建时间',
        'updated_at' => '更新时间',
        'captcha'    => '验证码'
    ];
}
