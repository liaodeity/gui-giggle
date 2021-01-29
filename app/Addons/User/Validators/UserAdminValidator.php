<?php
/**
 * Created by localhost.
 * User: gui
 * Email: liaodeity@gmail.com
 * Date: 2020-07-14
 */
namespace App\Addons\User\Validators;

use App\Validators\LiaoValidator;

/**
 * Class UserAdminValidator.
 * @package namespace App\Validators\User;
 */
class UserAdminValidator extends LiaoValidator
{
    /**
     * Validation Rules
     * @var array
     */
    protected $rules = [
        self::RULE_CREATE => [
            // 'user_id'=>'required',
			'username'=>'required',
			'password'=>'required',
			// 'status'=>'required',

        ],
        self::RULE_UPDATE => [
            // 'user_id'=>'required',
			'username'=>'required',
			'password'=>'required',
			// 'status'=>'required',

        ],
    ];
    protected $attributes = [
        'id'=>'编号',
		'user_id'=>'所属用户',
		'username'=>'登录名称',
		'password'=>'密码',
		'status'=>'状态',
		'created_at'=>'创建时间',
		'updated_at'=>'更新时间',

    ];
}
