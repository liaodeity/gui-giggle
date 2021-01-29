<?php
/**
 * Created by localhost.
 * User: gui
 * Email: liaodeity@foxmail.com
 * Date: [date]
 */

namespace App\Addons\User\Repositories\Interfaces;


use App\Addons\User\Models\User;
use App\Repositories\BaseInterface;

interface UserInterface extends BaseInterface
{
    /**
     * @param User $user
     * @return boolean;
     */
    public function allowDelete (User $user);
}
