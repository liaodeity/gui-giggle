<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: Gui < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

namespace App\Addons\CustomModule\Repositories;

use App\Addons\CustomModule\Models\Field;
use App\Addons\CustomModule\Repositories\Interfaces\FieldInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomModule\Validators\FieldValidator;
/**
 * Class FieldRepository.
 * @package namespace App\Addons\CustomModule\Repositories;
 */
class FieldRepository extends BaseRepository implements FieldInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Field::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return FieldValidator::class;
    }
    /**
     * @param Field $field
     * @return boolean;
     */
    public function allowDelete(Field $field)
    {
        return true;
    }
}
