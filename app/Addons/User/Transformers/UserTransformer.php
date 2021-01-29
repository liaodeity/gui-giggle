<?php
/**
 * Created by localhost.
 * User: gui
 * Email: liaodeity@gmail.com
 * Date: [date]
 */

namespace App\Addons\User\Transformers;



use App\Addons\User\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform (User $user)
    {
        return [
            'id'         => $user->id,
            'user_no'    => $user->user_no,
            'mobile'     => $user->mobile,
            'nickname'   => $user->nickname,
            'birthday'   => $user->birthday,
            '_gender'    => $user->genderItem ($user->gender),
            'gender'     => $user->gender,
            'reg_date'   => $user->reg_date,
            'created_at' => $user->created_at ? $user->created_at->format ('Y-m-d H:i:s') : null,
            'updated_at' => $user->updated_at ? $user->updated_at->format ('Y-m-d H:i:s') : null,
            '_show_url'  => url ('admin/user/' . $user->id),
            '_edit_url'  => url ('admin/user/' . $user->id . '/edit'),
            '_delete_url'  => url ('admin/user/' . $user->id . '/edit'),
            '_batch_delete' => url ('admin/user/delete/batch')
        ];
    }
}
