<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: Gui < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/
namespace App\Addons\Attachment\Models;

use App\Models\BaseModel;
use App\Traits\BelongsToUser;


class Attachment extends BaseModel
{
    use BelongsToUser;

    protected $table = 'attachments';

    protected $fillable = ['uuid','path','title','md5','sha1','mine_type','suffix','size','use_number','last_at','status','user_id','deleted_at','created_at','updated_at'];

    protected $dates = ['last_at','deleted_at','created_at','updated_at'];


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
