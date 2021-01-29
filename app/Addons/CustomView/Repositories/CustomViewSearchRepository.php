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

use App\Addons\CustomView\Models\CustomViewSearch;
use App\Addons\CustomView\Repositories\Interfaces\CustomViewSearchInterface;
use App\Repositories\BaseRepository;
use App\Addons\CustomView\Validators\CustomViewSearchValidator;
/**
 * Class CustomViewSearchRepository.
 * @package namespace App\Addons\CustomView\Repositories;
 */
class CustomViewSearchRepository extends BaseRepository implements CustomViewSearchInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return CustomViewSearch::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return CustomViewSearchValidator::class;
    }
    /**
     * @param CustomViewSearch $customViewSearch
     * @return boolean;
     */
    public function allowDelete(CustomViewSearch $customViewSearch)
    {
        return true;
    }
}
