<?php
/**
 * Created by localhost.
 * User: gui
 * Email: liaodeity@gmail.com
 * Date: 2020-07-14
 */

namespace App\Addons\User\Transformers;



use App\Addons\User\Models\UserAdmin;
use League\Fractal\TransformerAbstract;

class UserAdminTransformer extends TransformerAbstract
{
    public function transform (UserAdmin $userAdmin)
    {
        return [
            'id' => $userAdmin->id,
			'user_id' => $userAdmin->user_id,
			'username' => $userAdmin->username,
			'password' => $userAdmin->password,
			'_status' => $userAdmin->statusItem($userAdmin->status),
			'status' => $userAdmin->status,
			'created_at' => $userAdmin->created_at ? $userAdmin->created_at->format ('Y-m-d H:i:s') : null,
			'updated_at' => $userAdmin->updated_at ? $userAdmin->updated_at->format ('Y-m-d H:i:s') : null,

            '_show_url'  => url ('admin/user_admin/' . $userAdmin->id),
            '_edit_url'  => url ('admin/user_admin/' . $userAdmin->id . '/edit'),
            '_delete_url'  => url ('admin/user_admin/' . $userAdmin->id . '/edit'),
            '_batch_delete' => url ('admin/user_admin/delete/batch')
        ];
    }
}
