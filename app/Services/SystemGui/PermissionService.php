<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: 廖春贵 < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

namespace App\Services\SystemGui;

use App\Models\SystemGui\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionService add by gui
 * @package App\Services\SystemGui
 */
class PermissionService
{
    /**
     * 检查用户是否有权限 add by gui
     * @param string       $full_auth 完整权限名称
     * @param null|integer $user_id   用户UID
     * @return bool
     */
    protected function check ($full_auth, $user_id = null)
    {
        //TODO 默认拥有权限
        return true;
        $full_auth = strtolower ($full_auth);
        if (is_null ($user_id)) {
            $user_id = get_user_login_id ();
        }
        $user = User::find ($user_id);
        if (!$user) {
            return false;
        }
        $super = $user->isSuperAdmin ();

        if ($super) return true;//超级管理员
        Permission::findOrCreate ($full_auth, $user->guard_name);
        $auth = $user->hasPermissionTo ($full_auth);
        if ($auth) {
            return true;//拥有权限
        }

        return false;
    }

    /**
     * 拼接完整的权限名称 add by gui
     * @param string $model
     * @param string $auth
     * @return string|string[]
     */
    public function getAuthFullName ($model, $auth)
    {
        $full_auth = str_replace (['\\', '/'], '_', $model . '.' . $auth);
        $full_auth = strtolower ($full_auth);

        return $full_auth;
    }

    /**
     *  add by gui
     * @param string $model 模型名称
     * @param string $auth  权限标识名称
     * @return bool
     */
    public function checkToAuth ($model, $auth)
    {

        $full_auth = $this->getAuthFullName ($model, $auth);

        return $this->check ($full_auth);
    }

    public function checkToMethod ($model, array $methods)
    {
        $auth = [];
        foreach ($methods as $method) {
            $name = '';
            switch ($method) {
                case '__construct':
                case 'middleware':
                case 'getMiddleware':
                case 'callAction':
                case '__call':
                case 'authorize':
                case 'authorizeForUser':
                case 'authorizeResource':
                case 'dispatchNow':
                case 'validateWith':
                case 'validate':
                case 'validateWithBag':
                    //排除默认类方法名
                    break;
                case 'create':
                case 'store':
                    //添加
                    $name = 'create';
                    break;
                case 'edit':
                case 'update':
                    //修改
                    $name = 'edit';
                    break;
                case 'delete':
                case 'destroy':
                    $name = 'delete';
                    break;
                case 'show':
                    $name = 'show';
                    break;
                default:

                    break;
            }
            if ($name)
                $auth[ $name ] = $this->checkToAuth ($model, $name);
        }

        return $auth;
    }
}
