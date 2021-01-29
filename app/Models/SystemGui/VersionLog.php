<?php

namespace App\Models\SystemGui;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class VersionLog extends BaseModel
{
    protected $fillable = ['version','release_date','title','content','before_version','update_at','status','user_id','created_at','updated_at'];


    /**
     * 状态[1=已更新,2=未更新,3=更新中,4=更新失败] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function statusItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'status', $ind, $html);
    }


}
