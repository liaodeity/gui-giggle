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

namespace App\Addons\CustomView\Repositories;

use App\Addons\CustomView\Models\CustomView;
use App\Addons\CustomView\Repositories\Interfaces\CustomViewInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomView\Validators\CustomViewValidator;
/**
 * Class CustomViewRepository.
 * @package namespace App\Addons\CustomView\Repositories;
 */
class CustomViewRepository extends BaseRepository implements CustomViewInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return CustomView::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return CustomViewValidator::class;
    }
    /**
     * @param CustomView $customView
     * @return boolean;
     */
    public function allowDelete(CustomView $customView)
    {
        return true;
    }
}
