<?php

namespace App\Addons\User\Repositories;

use App\Addons\User\Models\User;
use App\Addons\User\Repositories\Interfaces\UserInterface;
use App\Addons\User\Validators\UserValidator;
use App\Repositories\BaseRepository;
/**
 * Class UserRepository.
 * @package namespace App\Repositories\SystemGui;
 */
class UserRepository extends BaseRepository implements UserInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return UserValidator::class;
    }
    /**
     * @param User $user
     * @return boolean;
     */
    public function allowDelete(User $user)
    {
        return true;
    }
}
