<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2020 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: 廖春贵 < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

namespace App\Http\Requests;


use App\Exceptions\SystemGuiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AddonsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules ()
    {
        return [];
    }

    public function messages ()
    {
        return [];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new SystemGuiException(implode(',', $validator->errors()->all()));
    }

    public function getFillData ()
    {

    }
}
