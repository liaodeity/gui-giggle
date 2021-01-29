<?php
/**
 * Created by PhpStorm.
 * User: gui
 * Date: 2020/9/21
 */

namespace App\Libs\Form\Contracts;


use App\Addons\CustomModule\Models\Module;
use App\Models\SystemGui\Field;
use Illuminate\Database\Eloquent\Model;

class BaseFrom implements Form
{
    public    $model;
    protected $menuActiveId;
    protected $urlPrefix = 'admin';
    protected $route;
    protected $data;

    public function __construct (Model $model, $data, $route, $menuId)
    {
        $this->model        = $model;
        $this->data         = $data;
        $this->route        = $route;
        $this->menuActiveId = $menuId;
    }

    public function model (): Model
    {
        return $this->model;
    }

    public function getCreateUrl ()
    {
        return url ($this->getPrefixPath () . '/create');
    }

    public function getPrefixPath ()
    {
        return $this->urlPrefix . '/' . $this->route;
    }

    public function getEditUrl ()
    {
        return url ($this->getPrefixPath () . '/' . $this->getModelId () . '/edit');
    }

    public function getModelId ()
    {
        return $this->model->id ?? 0;
    }

    public function getPostUrl ()
    {
        return $this->getListUrl ();
    }

    public function getListUrl ()
    {
        return url ($this->getPrefixPath ());
    }

    public function getPutUrl ()
    {
        return $this->getShowUrl ();
    }

    public function getShowUrl ()
    {
        return url ($this->getPrefixPath () . '/' . $this->getModelId ());
    }

    public function getMenuActiveId ()
    {
        return $this->menuActiveId;
    }

    public function getData ()
    {

    }

    public function getMethod ()
    {

    }

    /**
     * 获取字段内容 add by gui
     * @return mixed
     */
    public function getFields ()
    {
        //Module::where('name', $this->getM)
        //
        //$table  = $this->model ()->getTable ();
        //$fields = Field::where ('tab_name', $table)->get ();
        //$labels = [];
        //foreach ($fields as $field) {
        //    //$labels[ $field->field_name ] = $field->title;
        //}
        //
        //return $fields;
    }
}
