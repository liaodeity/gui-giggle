<?php
/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020/9/21
 */

namespace App\Libs\Form\Contracts;


use Illuminate\Database\Eloquent\Model;

interface Form
{
    public function __construct (Model $model, $data, $route, $menuId);

    public function getModelId ();

    public function getCreateUrl ();

    public function getEditUrl ();

    public function getPrefixPath ();

    public function getMenuActiveId ();

    public function getData ();

    public function getMethod ();
}
