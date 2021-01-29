<?php
/**
 * Created by liaodeity@gmail.com
 * User: gui
 * Date: 2020-07-14
 */

namespace App\Addons\User\Http\Requests;


use App\Http\Requests\AddonsRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends AddonsRequest
{

    public function getFillData ()
    {
        $data = $this->input ('User');

        return $data;
    }
}
