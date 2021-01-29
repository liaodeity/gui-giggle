<?php
/**
 * Created by localhost.
 * User: gui
 * Email: liaodeity@gmail.com
 * Date: 2020-07-14
 */
namespace App\Addons\User\Repositories;

use App\Addons\User\Models\UserAdmin;
use App\Addons\User\Repositories\Interfaces\UserAdminInterface;
use App\Addons\User\Validators\UserAdminValidator;
use App\Repositories\BaseRepository;
/**
 * Class UserAdminRepository.
 * @package namespace App\Repositories\User;
 */
class UserAdminRepository extends BaseRepository implements UserAdminInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return UserAdmin::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return UserAdminValidator::class;
    }
    /**
     * @param UserAdmin $userAdmin
     * @return boolean;
     */
    public function allowDelete(UserAdmin $userAdmin)
    {
        return true;
    }
}
