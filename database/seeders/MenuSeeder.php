<?php
namespace Database\Seeders;
use App\Addons\Menu\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $pidMenu = [
            [
                'auth_name' => 'console',
                'title'     => '控制台',
                'menu_name' => 'console',
                'route_url' => 'admin/console',
                'module'    => 1,
                'type'      => 1,
                'icon'      => 'iconfont icon-yemian-copy-copy',
                'status'    => 1,
                '_child'    => [

                ]
            ],
            [
                'auth_name' => 'content',
                'title'     => '内容管理',
                'menu_name' => 'content',
                'module'    => 1,
                'type'      => 1,
                'icon'      => 'iconfont icon-gongneng',
                'status'    => 1,
                '_child'    => [
                    [
                        'auth_name' => 'user',
                        'title'     => '用户资料',
                        'menu_name' => 'user',
                        'route_url' => 'admin/user',
                        'module'    => 1,
                        'type'      => 1,
                        'icon'      => 'fa fa-user',
                        'status'    => 1,
                    ],
                    [
                        'auth_name' => 'user_admin',
                        'title'     => '管理员账号',
                        'menu_name' => 'user_admin',
                        'route_url' => 'admin/user_admin',
                        'module'    => 1,
                        'type'      => 1,
                        'icon'      => 'fa fa-user',
                        'status'    => 1,
                    ],
                    [
                        'auth_name' => 'article',
                        'title'     => '资讯管理',
                        'menu_name' => 'article',
                        'route_url' => 'admin/article',
                        'module'    => 1,
                        'type'      => 1,
                        'icon'      => 'fa fa-list',
                        'status'    => 1,
                    ],
                    [
                        'auth_name' => 'category',
                        'title'     => '菜单栏目',
                        'menu_name' => 'category',
                        'route_url' => 'admin/category',
                        'module'    => 1,
                        'type'      => 1,
                        'icon'      => 'fa fa-list',
                        'status'    => 1,
                    ],
                ]
            ],
            [
                'auth_name' => 'system',
                'title'     => '系统管理',
                'menu_name' => 'system',
                'module'    => 1,
                'type'      => 1,
                'icon'      => 'iconfont icon-gongneng',
                'status'    => 1,
                '_child'    => [
                    [
                        'auth_name' => 'admin_config',
                        'title'     => '配置管理',
                        'menu_name' => 'config',
                        'route_url' => 'admin/config',
                        'module'    => 1,
                        'type'      => 1,
                        'icon'      => 'fa fa-gears',
                        'status'    => 1
                    ],
                    [
                        'auth_name' => 'admin_menu',
                        'title'     => '菜单管理',
                        'menu_name' => 'menu',
                        'route_url' => 'admin/menu',
                        'module'    => 1,
                        'type'      => 1,
                        'icon'      => 'fa fa-window-maximize',
                        'status'    => 1
                    ],
                    [
                        'auth_name' => 'role_info',
                        'title'     => '角色管理',
                        'menu_name' => 'role_info',
                        'route_url' => 'admin/role_info',
                        'module'    => 1,
                        'type'      => 1,
                        'icon'      => 'fa fa-list',
                        'status'    => 1
                    ],
                    //[
                    //    'auth_name' => '',
                    //    'title'     => '参数管理',
                    //    'route_url' => '',
                    //    'module'    => 1,
                    //    'type'      => 1,
                    //    'icon'      => 'fa fa-list',
                    //    'status'    => 1,
                    //    '_child'    => [
                    //
                    //    ]
                    //],
                    [
                        'auth_name' => 'admin_parameter',
                        'title'     => '参数名管理',
                        'menu_name' => 'parameter',
                        'route_url' => 'admin/parameter',
                        'module'    => 1,
                        'type'      => 1,
                        'icon'      => 'fa fa-list',
                        'status'    => 1
                    ],
                    [
                        'auth_name' => 'admin_parameter_item',
                        'title'     => '参数项管理',
                        'menu_name' => 'parameter-item',
                        'route_url' => 'admin/parameter_item',
                        'module'    => 1,
                        'type'      => 1,
                        'icon'      => 'fa fa-list',
                        'status'    => 1
                    ],
                    [
                        'auth_name' => 'admin_plugin',
                        'title'     => '应用市场',
                        'menu_name' => 'plugin',
                        'route_url' => 'admin/plugin',
                        'module'    => 1,
                        'type'      => 1,
                        'icon'      => 'fa fa-list',
                        'status'    => 1
                    ]
                ]
            ]
        ];
        Artisan::call ('dev:backup');
        Menu::where ('id', '<>', '')->delete ();
        foreach ($pidMenu as $key => $menu) {
            $childMenu = $menu['_child'] ?? [];
            unset($menu['_child']);
            $menu['sort'] = $key + 1;
            $first        = Menu::create ($menu);
            foreach ($childMenu as $key2 => $child) {
                $twoMenu = $child['_child'] ?? [];
                unset($child['_child']);
                $child['pid']  = $first->id;
                $child['sort'] = $key2 + 1;
                $two           = Menu::create ($child);
                foreach ($twoMenu as $key3 => $twoChild) {
                    $twoChild['pid']  = $two->id;
                    $twoChild['sort'] = $key3 + 1;
                    Menu::create ($twoChild);
                }
            }
        }
        //Menu::where ();
    }
}
