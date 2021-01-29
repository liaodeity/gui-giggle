<?php

namespace App\Models\SystemGui;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class SystemLog extends BaseModel
{
    protected $fillable = ['type','title','content','user_id','created_at','updated_at'];


    /**
     * 日志类型[1=登录,2=添加,3=修改,4=删除,5=查看,6=信息,7=异常] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function typeItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'type', $ind, $html);
    }


}
