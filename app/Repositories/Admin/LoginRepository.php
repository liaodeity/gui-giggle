<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( MIT )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: Gui < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

namespace App\Repositories\Admin;

use App\Addons\Login\Models\Login;
use App\Repositories\BaseRepository;
use App\Addons\Login\Validators\LoginValidator;
/**
 * Class LoginRepository.
 * @package namespace App\Addons\Login\Repositories;
 */
class LoginRepository extends BaseRepository
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Login::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return LoginValidator::class;
    }
    /**
     * @param Login $login
     * @return boolean;
     */
    public function allowDelete(Login $login)
    {
        return true;
    }
}
