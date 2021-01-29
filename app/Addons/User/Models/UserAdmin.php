<?php
/**
 * Created by localhost.
 * User: gui
 * Email: liaodeity@gmail.com
 * Date: 2020-07-14
 */
namespace App\Addons\User\Models;

use App\Models\BaseModel;
use App\Traits\BelongsToUser;


class UserAdmin extends BaseModel
{
    use BelongsToUser;

    protected $table = 'user_admins';

    protected $fillable = ['user_id','username','password','status','created_at','updated_at'];

    protected $dates = ['created_at','updated_at'];


    /**
     * 状态[1=使用中,4=已禁用] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function statusItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'status', $ind, $html);
    }


}
