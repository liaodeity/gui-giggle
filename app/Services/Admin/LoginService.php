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

namespace App\Services\Admin;


use App\Addons\User\Models\UserAdmin;
use App\Addons\User\Models\UserToken;
use App\Exceptions\SystemGuiException;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    /**
     *  add by gui
     * @param      $loginType
     * @param      $username
     * @param      $password
     * @return bool
     * @throws SystemGuiException
     */
    public function check ($loginType, $username, $password)
    {
        if (empty($username)) {
            throw  new SystemGuiException('请输入登录账号');
        }
        if (empty($password)) {
            throw new SystemGuiException('请输入账号密码');
        }
        ////TODO 测试登录用户
        //session ()->put ('LOGIN_USER_UID', 1);
        //return true;
        switch ($loginType) {
            case 'admin':
                $user = UserAdmin::where ('username', $username)->first ();
                break;
            case 'agent':
                $user = Agent::where ('username', $username)->first ();
                break;
            default :
                throw new SystemGuiException('登录类型不正确');
        }
        if (!isset($user->id)) {
            throw new SystemGuiException('登录账号不正确');
        }

        if (!Hash::check ($password, $user->password)) {
            throw new SystemGuiException('账号密码不正确');
        }

        if ($user->status != 1) {
            throw new SystemGuiException('账号已禁止登录');
        }

        //登录标识UID
        session ()->put ('LOGIN_USER_UID', $user->user_id);

        return $user->user_id;
    }

    /**
     * 检查token add by gui
     * @param $token
     */
    public function checkToken ($token)
    {
        $now       = now ()->toDateTimeString ();
        $userToken = UserToken::where ('token', $token)->where ('expired_at', '>=', $now)->first ();

        return $userToken ? true : false;
    }

    /**
     * 通过token登录 add by gui
     * @param $token
     */
    public function loginToken ($token)
    {
        $now       = now ()->toDateTimeString ();
        $userToken = UserToken::where ('token', $token)->where ('expired_at', '>=', $now)->first ();
        $userId    = $userToken->user_id ?? '';
        session ()->put ('LOGIN_USER_UID', $userId);
        session ()->put ('LOGIN_X_TOKEN', $token);
    }
}
