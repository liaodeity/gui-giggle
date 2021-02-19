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
namespace App\Addons\Parameter\Repositories;


use App\Addons\Parameter\Models\Parameter;
use App\Addons\Parameter\Repositories\Interfaces\ParameterInterface;
use App\Addons\Plugin\Validators\ParameterValidator;
use App\Repositories\BaseInterface;
use App\Repositories\BaseRepository;
/**
 * Class ParameterRepository.
 * @package namespace App\Repositories\Parameter;
 */
class ParameterRepository extends BaseRepository implements ParameterInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Parameter::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return ParameterValidator::class;
    }
    /**
     * @param Parameter $parameter
     * @return boolean;
     */
    public function allowDelete(Parameter $parameter)
    {
        return true;
    }
}
