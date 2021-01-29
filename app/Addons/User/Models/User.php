<?php

namespace App\Addons\User\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends BaseModel
{
    use HasRoles;
    protected $fillable   = ['user_no', 'mobile', 'nickname', 'birthday', 'gender', 'reg_date', 'real_name', 'id_number', 'live_address', 'created_at', 'updated_at'];
    public    $guard_name = 'user'; // 用户权限标签

    protected $dates = ['deleted_at','created_at','updated_at'];

    /**
     * 是否超级管理员 add by gui
     * @return bool
     */
    public function isSuperAdmin ()
    {
        $auth = $this->hasRole ('super');

        return $auth ? true : false;
    }

    /**
     * 性别[1=男,2=女] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function genderItem ($ind = 'all', $html = false)
    {
        return get_db_parameter (self::class, 'gender', $ind, $html);
    }

    /**
     * 会员状态[1=使用中,4=已禁用] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function statusItem ($ind = 'all', $html = false)
    {
        return get_db_parameter (self::class, 'status', $ind, $html);
    }

    public static function showName ()
    {
        $userId = get_user_login_id ();
        $user   = User::find ($userId);

        return $user->nickname ?? '';
    }
}
