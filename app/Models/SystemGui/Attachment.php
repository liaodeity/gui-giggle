<?php
/**
 * Created by localhost.
 * User: gui
 * Email: liaodeity@gmail.com
 * Date: 2020-07-03
 */

namespace App\Models\SystemGui;

use App\Models\BaseModel;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\SoftDeletes;


class Attachment extends BaseModel
{
    use BelongsToUser, SoftDeletes;

    protected $table = 'attachments';

    protected $fillable = ['uuid', 'path', 'title', 'md5', 'sha1', 'mine_type', 'suffix', 'size', 'use_number', 'last_at', 'status', 'user_id', 'deleted_at', 'created_at', 'updated_at'];

    protected $dates = ['last_at', 'deleted_at', 'created_at', 'updated_at'];


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

    /**
     * 保存附件信息，根据SHA和MD5判断是否重复，重复标记记录status=-1，
     * 由定时任务清理重复附件，释放空间
     * add by gui
     * @param $insArr
     * @return mixed
     */
    public static function addFile ($insArr)
    {
        if (array_get ($insArr, 'user_id', 0) == 0) {
            $insArr['user_id'] = get_user_login_id ();
        }
        $insArr['uuid']        = get_uuid ();
        $md5                   = array_get ($insArr, 'md5', '');
        $sha1                  = array_get ($insArr, 'sha1', '');
        $pic                   = Attachment::where ('md5', $md5)->where ('sha1', $sha1)->first ();
        $insArr['access_id']   = array_get ($insArr, 'access_id', '');
        $insArr['access_type'] = array_get ($insArr, 'access_type', '');
        if (isset($pic->id)) {
            if (!file_exists ($pic->path)) {
                //删除重复文件
                $pic->path = $insArr['path'];
                $pic->save ();
            }
        } else {
            $pic = Attachment::create ($insArr);
        }
        AttachmentAccess::create ([
            'attachment_id' => $pic->id,
            'access_id'     => $insArr['access_id'],
            'access_type'   => $insArr['access_type']
        ]);

        return $pic;
    }


}
