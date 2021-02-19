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
namespace App\Addons\Plugin\Models;

use App\Models\BaseModel;
use App\Traits\BelongsToUser;


class Plugin extends BaseModel
{
    use BelongsToUser;

    protected $table = 'plugins';

    protected $fillable = ['name','version','title','cover_img','content','depend','file_tree','is_install','is_update','install_at','user_id','deleted_at','created_at','updated_at'];

    protected $dates = ['install_at','deleted_at','created_at','updated_at'];


    /**
     * 是否安装[1=是,0=否] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isInstallItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_install', $ind, $html);
    }

    /**
     * 是否更新[1=是,0=否] add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function isUpdateItem($ind = 'all', $html = false)
    {
        return get_db_parameter(self::class, 'is_update', $ind, $html);
    }


}
