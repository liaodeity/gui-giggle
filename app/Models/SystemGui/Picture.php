<?php

namespace App\Models\SystemGui;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Picture extends BaseModel
{
    protected $fillable = ['path','title','md5','sha1','last_at','status','user_id','access_id','access_type','created_at','updated_at'];


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
