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

namespace App\Addons\User\Services;





use App\Addons\Menu\Repositories\MenuRepository;

class AdminService
{
    public static function getMenuList ()
    {
        $menuRepository = app ()->make (MenuRepository::class);
        $menuInfo       = $menuRepository->getMenuList ();

        return $menuInfo;
    }

    /**
     * 获取菜单层级列表 add by gui
     * @param $menuId
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function getMenuNav ($menuId)
    {
        $menuRepository = app ()->make (MenuRepository::class);
        $menuLevel      = $menuRepository->getMenuLevel ($menuId);

        return $menuLevel;
    }
}
