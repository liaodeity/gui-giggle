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
namespace App\Addons\Menu\Models;

use App\Models\BaseModel;

/**
 * Class Menu.
 * @package namespace App\Models;
 */
class Menu extends BaseModel
{
    const MENU_TYPE_AUTH = 'auth';
    const MENU_TYPE_MENU = 'menu';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'pid',
        'auth_name',
        'module',
        'type',
        'sort',
        'route_url',
        'title',
        'icon',
        'status',
    ];

    protected $guarded = [];

    /**
     * add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function moduleItem ($ind = 'all', $html = false)
    {
        return get_db_parameter (self::class, 'module', $ind, $html);
    }

    /**
     * add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function statusItem ($ind = 'all', $html = false)
    {
        return get_db_parameter (self::class, 'status', $ind, $html);
    }

    /**
     * add by gui
     * @param string $ind
     * @param bool   $html
     * @return array|mixed|string|null
     */
    public function typeItem ($ind = 'all', $html = false)
    {
        return get_db_parameter (self::class, 'type', $ind, $html);
    }
}
