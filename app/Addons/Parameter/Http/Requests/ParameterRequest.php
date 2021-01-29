<?php
/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020-07-28
 */

namespace App\Addons\Parameter\Http\Requests;


use App\Http\Requests\AddonsRequest;
use Illuminate\Foundation\Http\FormRequest;

class ParameterRequest extends AddonsRequest
{

    public function getFillData ()
    {
        $data = $this->input ('Parameter');

        return $data;
    }
}
