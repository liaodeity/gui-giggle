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
namespace App\Addons\Menu\Repositories;

use App\Addons\Menu\Models\Menu;
use App\Addons\Menu\Repositories\Interfaces\MenuInterface;
use App\Addons\Menu\Validators\MenuValidator;
use App\Repositories\BaseRepository;

/**
 * Class MenuRepository.
 * @package namespace App\Repositories\SystemGui;
 */
class MenuRepository extends BaseRepository implements MenuInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model ()
    {
        return Menu::class;
    }

    public function boot ()
    {
        return true;
    }

    public function validator ()
    {
        return MenuValidator::class;
    }

    /**
     * @param Menu $menu
     * @return boolean;
     */
    public function allowDelete (Menu $menu)
    {
        return true;
    }

    // 获取菜单列表
    public function getMenuList ()
    {
        $menuList = Menu::where ('type', 1)
            ->where ('status', 1)
            ->orderBy ('sort', 'ASC')
            ->get ();
        $menuList = $this->buildMenuChild ('', $menuList);

        return $menuList;
    }

    //递归获取子菜单
    private function buildMenuChild ($pid, $menuList)
    {
        $treeList = [];
        foreach ($menuList as $v) {
            if ($pid == $v->pid) {
                $node  = [
                    'id'     => $v->id,
                    'pid'    => $v->pid,
                    'title'  => $v->title,
                    'icon'   => $v->icon,
                    'href'   => $v->route_url,
                    'active' => $v->auth_name,
                    'target' => '_self',
                ];
                $child = $this->buildMenuChild ($v->id, $menuList);
                if (!empty($child)) {
                    $node['child'] = $child;
                }
                // todo 后续此处加上用户的权限判断
                $treeList[] = $node;
            }
        }

        return $treeList;
    }

    public function getMenuLevel ($menuId, $menus = [])
    {
        $menu = Menu::where ('id', $menuId)->first ();
        if ($menu) {
            array_unshift ($menus, $menu);
        }
        if ($menu && isset($menu->pid)) {
            return $this->getMenuLevel ($menu->pid, $menus);
        }

        return $menus;
    }
}
