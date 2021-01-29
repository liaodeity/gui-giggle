<?php

namespace App\Addons\User\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToUser;


class Admin extends BaseModel
{
    use BelongsToUser;
    protected $table = 'user_admins';
    protected $fillable = ['user_id', 'username', 'password', 'status', 'created_at', 'updated_at'];

    protected $dates = ['created_at', 'updated_at'];

    protected $hidden = ['password'];

    /**
     * 状态[1=使用中,4=已禁用] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function statusItem ($ind = 'all', $html = false)
    {
        return get_db_parameter (self::class, 'status', $ind, $html);
    }


}
