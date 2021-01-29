<?php

namespace App\Models\SystemGui;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class DbBackup extends BaseModel
{
    protected $fillable = ['user_id','name','path','start_at','end_at','size','status','created_at','updated_at'];


    /**
     * 状态[1=已备份,2=备份中,4=备份失败] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function statusItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'status', $ind, $html);
    }


}
