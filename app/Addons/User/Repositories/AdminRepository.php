<?php

namespace App\Addons\User\Repositories;

use App\Addons\User\Models\Admin;
use App\Addons\User\Repositories\Interfaces\AdminInterface;
use App\Addons\User\Validators\AdminValidator;
use App\Exceptions\SystemGuiException;
use App\Repositories\BaseRepository;

/**
 * Class AdminRepository.
 * @package namespace App\Repositories\SystemGui;
 */
class AdminRepository extends BaseRepository implements AdminInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Admin::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return AdminValidator::class;
    }
    /**
     * @param Admin $admin
     * @return boolean;
     */
    public function allowDelete(Admin $admin)
    {
        if($admin->username == 'admin'){
            throw new SystemGuiException('超级管理员，不允许删除');
        }
        return true;
    }
}
