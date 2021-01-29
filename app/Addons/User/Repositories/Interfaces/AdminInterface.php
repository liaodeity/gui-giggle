<?php
/**
 * Created by localhost.
 * User: gui
 * Email: liaodeity@gmail.com
 * Date: [date]
 */

namespace App\Addons\User\Repositories\Interfaces;


use App\Addons\User\Models\Admin;
use App\Repositories\BaseInterface;

interface AdminInterface extends BaseInterface
{
    /**
     * @param Admin $admin
     * @return boolean;
     */
    public function allowDelete (Admin $admin);
}
