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

namespace App\Http\Controllers\Admin;


use App\Addons\Login\Services\LoginService;
use App\Addons\User\Repositories\UserRepository;
use App\Addons\User\Validators\UserValidator;
use App\Exceptions\SystemGuiException;
use App\Models\SystemGui;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mews\Captcha\Facades\Captcha;
use stdClass;

class LoginController extends Controller
{
    /**
     * @var LoginService
     */
    private $loginService;
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * LoginController constructor.
     * @param UserRepository $repository
     * @param LoginService   $loginService
     */
    public function __construct (UserRepository $repository, LoginService $loginService)
    {
        $this->loginService = $loginService;
        $this->repository = $repository;
    }

    /**
     * 后台登录 add by gui
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin ()
    {
        $loginType = 'admin';
        //$this->setRememberPassword ('', '');
        $remember = $this->getRememberPassword ();

        //dd ($remember);

        return view ('admin.login.admin_login', compact ('loginType', 'remember'));
    }

    /**
     * 机构登录 add by gui
     */
    public function agent ()
    {
        $loginType = 'agent';

        return view ('admin.login.agent_login', compact ('loginType'));
    }

    /**
     * 登录认证 add by gui
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check (Request $request)
    {
        $loginType     = $request->input ('loginType');
        $username      = $request->input ('username');
        $password      = $request->input ('password');
        $captcha       = $request->input ('captcha');
        $rememberMe    = $request->input ('rememberMe');
        $rememberToken = $request->input ('rememberToken');

        try {

            $this->repository->makeValidator ()->with ($request->all ())->passes (UserValidator::RULE_ADMIN_LOGIN);

            //记住密码
            $remember = $this->getRememberPassword ();
            if (captcha_check ($captcha) !== true) {
                $this->refreshSessionPlus ();

                return ajax_error_message (__ ('message.login.captcha_fail'), ['refresh' => true]);
            }


            $hash = false;
            if ($rememberToken && $rememberToken == $remember->token) {
                $password = $remember->password;
                $hash     = true;
                //$hash_password = $password;
            } else {
                //$hash_password = $password;
            }
            //确保记住密码只认证一次
            $this->setRememberPassword ('', '');

            $this->loginService->check ($loginType, $username, $password);
            //Log::createLog (Log::LOGIN_TYPE, $username . '登录系统');
            //取消锁屏
            //$this->lockScreenService->setType ($loginType)->cancelLock ();

            //记住密码
            if ($rememberMe) {
                $this->setRememberPassword ($username, $password);
            }

            return ajax_success_message (__ ('message.login.success'), ['url' => url ($loginType)]);

        } catch (SystemGuiException $e) {
            $this->refreshSessionPlus ();

            return ajax_error_message ($e->getMessage (), ['refresh' => true]);
        }
    }

    protected function refreshSessionPlus ()
    {
        $num = session ()->get ('login.check.error.number', 0);
        session ()->put ('login.check.error.number', $num + 1);
    }

    protected function checkRefresh ()
    {
        $num = session ()->get ('login.check.error.number');
        captcha ();//刷新一次验证码

        return $num >= 5 ? true : false;
    }

    /**
     * 记住密码 add by gui
     * @param $username
     * @param $password
     */
    protected function setRememberPassword ($username, $password)
    {
        if (!$username || !$password) {
            session ()->forget ('LoginToken');
        }
        $obj              = new stdClass;
        $obj->check       = true;
        $obj->username    = $username;
        $obj->password    = $password;
        $obj->en_password = '********';
        $obj->token       = sha1 (encrypt ($password));

        $value = encrypt ($obj);

        //7天
        session ()->put ('LoginToken', $value);
    }

    /**
     * 获取是否有记住密码 add by gui
     * @return bool|mixed
     */
    protected function getRememberPassword ()
    {
        $value = session ()->get ('LoginToken');
        if ($value) {
            $arr = @decrypt ($value);

            return $arr;
        }
        $obj              = new stdClass;
        $obj->check       = false;
        $obj->username    = '';
        $obj->password    = '';
        $obj->en_password = '';
        $obj->token       = '';

        return $obj;
    }

    public function captcha ()
    {
        $type = get_config_value ('system_gui.captcha_type', 'math');
        switch ($type) {
            case 'math':
            case 'type1':
            case 'default':
                break;
            case 'random':
                $type = array_random (['math', 'type1']);
                break;
            default:
                $type = 'math';
                break;
        }

        return captcha ($type);
    }
}
