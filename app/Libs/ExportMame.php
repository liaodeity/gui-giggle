<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: 廖春贵 < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

namespace App\Libs;


class ExportMame
{

    private $request;

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function getName($module, $params = [])
    {
        $export_name = $module . '';
        $search = '';
        foreach ($params as $key => $param) {
            $value = $this->request[$key] ?? '';
            if ($value) {
                $search .= $param . "_" . $value . ",";
            }
            $start = $this->request[$key . '_start'] ?? '';
            $end = $this->request[$key . '_end'] ?? '';
            if ($start || $end) {
                $search .= $param . "_(" . $start . '至' . $end . ')';
            }
        }
        if ($search) {
            $search = trim($search, ',');
            $export_name .= '[' . $search . ']';
        }
        $export_name .= date('Ymd');
        return $export_name;
    }
}
