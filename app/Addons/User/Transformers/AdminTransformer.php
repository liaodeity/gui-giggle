<?php
/**
 * Created by localhost.
 * User: gui
 * Email: liaodeity@gmail.com
 * Date: [date]
 */

namespace App\Addons\User\Transformers;


use App\Models\SystemGui\Admin;
use League\Fractal\TransformerAbstract;

class AdminTransformer extends TransformerAbstract
{
    public function transform (Admin $admin)
    {

        return [
            'id'         => $admin->id,
            'user_id'    => $admin->user_id,
            'username'   => $admin->username,
            //'password' => $admin->password,
            '_status'    => $admin->statusItem ($admin->status),
            'status'     => $admin->status,
            'user'       => [
                'nickname' => $admin->user->nickname ?? ''
            ],
            'created_at' => $admin->created_at->format ('Y-m-d H:i:s') ?? '',
            'updated_at' => $admin->updated_at->format ('Y-m-d H:i:s') ?? '',

        ];
    }
}
