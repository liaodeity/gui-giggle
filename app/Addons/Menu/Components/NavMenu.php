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

class NavMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct ()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render ()
    {
        $menus = AdminService::getMenuList ();

        return view ('menu::components.nav-menu', compact ('menus'));
    }
}
