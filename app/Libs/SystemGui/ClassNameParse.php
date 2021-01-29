<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2020 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: 廖春贵 < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

namespace App\Libs\SystemGui;


use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class ClassNameParse
{
    private $moduleName = '';
    private $className  = '';

    public static function config ()
    {
        $ClassNameParse = new ClassNameParse();
        $root_url       = request ()->root ();
        $current_url    = url ()->current ();
        //dd (request ()->route ());
        $action_name = request ()->route ()->getActionName ();
        $f_name      = request ()->route ()->getActionMethod ();
        $r_prefix    = request ()->route ()->getPrefix ();
        $ClassNameParse->setClassName ($action_name);
        $c_name = $ClassNameParse->getClassName ();

        return [
            'ROOT_URL'       => $root_url,
            'CURRENT_URL'    => $current_url,
            'ROUTE_PREFIX'   => $r_prefix . '/' . $c_name,
            'MODULE_NAME'    => $ClassNameParse->getModuleName (),
            'CLASS_NAME'     => $c_name,
            'METHOD_NAME'    => $f_name,
            'SUCCESS_TIME'   => 1500,
            'ERROR_TIP_TIME' => 2500,
            'NO_SELECT_DATA' => __ ('message.tips.no_select_data'),
            'FAIL_ACCESS'    => __ ('message.fail.access')
        ];
    }

    /**
     *  add by gui
     * @param $c_name
     * @return ClassNameParse
     */
    public function setClassName ($c_name): ClassNameParse
    {
        $c_name = str_replace ('\\', '#', $c_name);
        preg_match ('/^App#Http#Controllers#(.*?)#(.*?)Controller/', $c_name, $match);
        $this->moduleName = $match[1] ?? '';
        $this->className  = $match[2] ?? '';

        return $this;
    }

    public function getClassName ()
    {
        return Str::snake ($this->className);
    }

    public function getModuleName ()
    {
        return Str::snake ($this->moduleName);
    }

    public function getViewModuleName ()
    {
        return Str::snake ($this->moduleName);
    }
}
