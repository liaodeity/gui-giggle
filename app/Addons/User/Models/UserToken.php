<?php

namespace App\Addons\User\Models;

use App\Exceptions\SystemGuiException;
use App\Models\BaseModel;
use Carbon\Carbon;
use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserToken extends BaseModel
{
    const ADMIN_TOKEN = 'admin';
    const PC_TOKEN    = 'pc';
    const WEB_TOKEN   = 'web';
    const AGENT_TOKEN = 'agent';
    protected $fillable = ['type', 'user_id', 'token', 'expired_at'];

    /**
     * 生成用户类型的Token add by gui
     * @param $type
     * @param $user_id
     * @return string
     * @throws SystemGuiException
     */
    public static function createToken ($type, $user_id)
    {
        $token      = (string)Str::uuid ();
        $hour       = config ('system_gui.user_token_expired_hour');
        $expired_at = Carbon::parse (now ())->addHour ($hour);//有效期
        $ret        = UserToken::create ([
            'type'       => $type,
            'user_id'    => $user_id,
            'token'      => $token,
            'expired_at' => $expired_at
        ]);
        if ($ret) {
            return $token;
        } else {
            throw new SystemGuiException(__ ('user.token.create_fail'));
        }
    }

    /**
     * 将token立马过期 add by gui
     * @param $token
     * @param $user_id
     * @return bool
     * @throws SystemGuiException
     */
    public static function disableToken ($token, $user_id)
    {
        $ret = UserToken::where ('token', $token)->where ('user_id', $user_id)->update (['expired_at' => now ()]);
        if ($ret) {
            return true;
        } else {
            throw new SystemGuiException('退出失败');

            return false;
        }

    }
}
