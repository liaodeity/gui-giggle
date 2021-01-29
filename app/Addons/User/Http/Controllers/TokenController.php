<?php

namespace App\Http\Controllers\SystemGui;

use App\Addons\Login\Services\LoginService;
use App\Addons\User\Models\UserToken;
use App\Addons\User\Repositories\UserRepository;
use App\Addons\User\Validators\UserValidator;
use App\Exceptions\SystemGuiException;
use App\Http\Controllers\Controller;
use App\Libs\SystemGui\SignatureEncryption;
use Illuminate\Http\Request;

class TokenController extends Controller
{

    public function adminToken (Request $request, UserRepository $userRepository)
    {
        $username  = $request->input ('username');
        $password  = $request->input ('password');
        $input     = $request->all ();
        $loginType = UserToken::ADMIN_TOKEN;
        try {
            $loginService = new LoginService;
            $userRepository->makeValidator ()->with ($input)->passes (UserValidator::ADMIN_API_LOGIN);
            $user_id = $loginService->check ($loginType, $username, $password);
            $token   = UserToken::createToken ($loginType, $user_id);
            $result  = [
                'data' => [
                    'token' => $token
                ]
            ];

            return ajax_success_message ('', $result);
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }
    }

    public function agentToken ()
    {

    }

    /**
     * 无登录 add by gui
     */
    public function accountToken (Request $request)
    {

        $Sign       = new SignatureEncryption();
        $check      = $Sign->checkSign ($request->all ());
        $login_type = $request->input ('login_type', 'web');
        if ($check) {
            $token  = UserToken::createToken ($login_type, '');
            $result = [
                'data' => [
                    'token' => $token
                ]
            ];

            return ajax_success_message ('', $result);
        } else {
            return ajax_error_message ('签名认证失败');
        }
    }

    /**
     * 退出登录 add by gui
     */
    public function logoutToken ()
    {
        try {
            $x_token = get_user_x_token ();
            $user_id = get_user_login_id ();
            UserToken::disableToken ($x_token, $user_id);
            session ()->flush ();

            return ajax_success_message ('退出账号成功');
        } catch (SystemGuiException $e) {
            return ajax_error_message ($e->getMessage ());
        }


    }
}
