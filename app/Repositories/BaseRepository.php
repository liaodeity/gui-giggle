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

namespace App\Repositories;

use App\Exceptions\PermissionCheckException;
use App\Models\SystemGui\Config;
use App\Services\SystemGui\PermissionService;
use App\Transformers\SystemGui\ConfigTransformer;
use App\Validators\LiaoValidator;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection as FractalCollection;
use League\Fractal\Resource\Item as FractalItem;
use League\Fractal\TransformerAbstract;

abstract class BaseRepository implements BaseInterface
{
    /**
     * @var Application
     */
    protected $app;
    /**
     * @var Model
     */
    protected $model;
    protected $authName = 'admin';
    protected $primaryKey = 'id';
    /**
     * 已检测的权限列表
     * @var array
     */
    private $permission = null;

    public function __construct ()
    {
        $this->app = app();
        $this->makeModel ();
        $this->boot ();
    }

    /**
     * add by gui
     * @return Model|mixed
     * @throws Exception
     */
    public function makeModel (): Model
    {
        $model = $this->app->make ($this->model ());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * add by gui
     * @return Model|mixed
     * @throws Exception
     */
    public function makeValidator (): LiaoValidator
    {
        $validator = $this->app->make ($this->validator ());

        if (!$validator instanceof LiaoValidator) {
            throw new Exception("Class {$this->validator()} must be an instance of App\\Validators\\LiaoValidator");
        }

        return $this->validator = $validator;
    }

    /**
     * add by gui
     * @param $id
     * @return mixed
     */
    public function find ($id)
    {
        return $this->model->find ($id);
    }


    /**
     * add by gui
     * @param array $attributes
     * @return mixed
     */
    public function create (array $attributes)
    {
        return $this->model->create ($attributes);
    }

    /**
     * add by gui
     * @param array $attributes
     * @param       $id
     * @return mixed
     */
    public function update (array $attributes, $id)
    {
        $model = $this->model->findOrFail ($id);
        $model->fill ($attributes);
        $model->save ();

        return $model;
    }

    /**
     *  add by gui
     * @param array $attributes
     * @return mixed
     */
    public function save (array $attributes)
    {
        $id = data_get ($attributes, 'id');
        if ($id) {
            return $this->update ($attributes, $id);
        } else {
            return $this->save ($attributes);
        }
    }

    /**
     * add by gui
     * @param $id
     * @return mixed
     */
    public function delete ($id)
    {
        $info = $this->model->find ($id);

        return $info->delete ();
    }

    /**
     * 获取所有用户角色权限 add by gui
     */
    public function getPermission ($class)
    {
        if (!is_null ($this->permission)) {
            return $this->permission;
        }
        $list    = (get_class_methods ($class));
        $methods = [];
        foreach ($list as $method) {
            if (method_exists ($class, $method)) {
                $methods[] = $method;
            }
        }
        $PermissionService = new PermissionService();
        $this->permission  = $PermissionService->checkToMethod ($this->model, $methods);

        return $this->permission;
    }

    /**
     * 检测用户是否有角色权限 add by gui
     * @param string $type
     * @return mixed
     * @throws PermissionCheckException
     */
    public function checkPermission ($type = 'admin')
    {
        $method = request ()->route ()->getActionMethod ();
        if (is_null ($this->permission)) {
            $PermissionService = new PermissionService();
            $check             = $PermissionService->checkToAuth ($this->model (), $method . '.' . $type);
        } else {
            $check = array_get ($this->permission, $method, false);
        }

        if ($check !== true) {
            $msg = __ ('message.permission.check_error');
            throw new PermissionCheckException($msg);
        }

        return $check;
    }

    /**
     * 数据记录权限检查 add by gui
     * @param $name
     * @return bool
     */
    public function auth ($name)
    {
        return true;
    }

    /**
     * @return string
     */
    public function getAuthName (): string
    {
        return $this->authName;
    }

    public function transformerCollection ($data, TransformerAbstract $transformer)
    {
        $fractal    = new Manager();
        $collection = new FractalCollection($data, $transformer);

        if ($data instanceof LengthAwarePaginator) {
            $collection->setPaginator (new IlluminatePaginatorAdapter($data));
        }

        return $fractal->createData ($collection)->toArray ();
    }

    public function transformerItem ($data, TransformerAbstract $transformer)
    {
        $fractal    = new Manager();
        $collection = new FractalItem($data, $transformer);
        return $fractal->createData ($collection)->toArray ();
    }
}
