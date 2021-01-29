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
namespace App\Addons\Menu\Components;

use App\Addons\User\Services\AdminService;
use Illuminate\View\Component;

class BreadcrumbPath extends Component
{
    /**
     * @var string
     */
    public $menuId;
    /**
     * @var string
     */
    public $path;

    /**
     * Create a new component instance.
     *
     * @param $menuId
     * @param $path
     */
    public function __construct ($menuId, $path = '')
    {
        $this->menuId = $menuId;
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render ()
    {
        $menus = AdminService::getMenuNav ($this->menuId ?? '');
        $pathArr = [];
        if($this->path){
            $pathArr = explode ('/',$this->path);
        }
        return view ('menu::components.breadcrumb-path', compact ('menus','pathArr'));
    }
}
