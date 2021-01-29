<?php
/**
 * Created by localhost.
 * User: gui
 * Email: liaodeity@gmail.com
 * Date: 2020-07-14
 */

namespace App\Addons\User\Repositories\Interfaces;


use App\Addons\User\Models\UserAdmin;
use App\Repositories\BaseInterface;

interface UserAdminInterface extends BaseInterface
{
    /**
     * @param UserAdmin $userAdmin
     * @return boolean;
     */
    public function allowDelete (UserAdmin $userAdmin);
}
