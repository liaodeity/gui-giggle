<?php
/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020/9/22
 */

namespace App\Libs\Form;


use App\Libs\Form\Contracts\BaseFrom;

class FormEditData extends BaseFrom
{
    public function getMethod ()
    {
        return 'PUT';
    }
}
