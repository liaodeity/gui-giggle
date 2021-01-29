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
namespace App\Addons\Config\Repositories;

use App\Addons\Config\Models\Config;
use App\Addons\Config\Validators\ConfigValidator;
use App\Repositories\BaseInterface;
use App\Repositories\BaseRepository;
use BaconQrCode\Common\Mode;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConfigRepository.
 * @package namespace App\Repositories\Admin;
 */
class ConfigRepository extends BaseRepository
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model ()
    {
        return Config::class;
    }

    public function boot ()
    {
        return true;
    }

    /**
     * @param Config $config
     * @return boolean;
     */
    public function allowDelete (Config $config)
    {
        return true;
    }

    public function validator ()
    {
        return ConfigValidator::class;
    }
}
