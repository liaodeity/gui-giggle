<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( MIT )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: 廖春贵 < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

namespace App\Libs;


class ArrayHelper
{
    public static function listToTree ($list, $pk = 'id', $pid = 'pid', $child = 'child', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if (is_array ($list)) {

            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[ $data[ $pk ] ] =& $list[ $key ];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[ $pid ];
                if ($root == $parentId) {
                    $tree[] =& $list[ $key ];
                } else {
                    if (isset($refer[ $parentId ])) {
                        $parent             =& $refer[ $parentId ];
                        $parent[ $child ][] =& $list[ $key ];
                    }
                }
            }
        }

        return $tree;
    }

    /**
     * 格式化select前端内容 add by gui
     * @param $items
     * @return array
     */
    public static function selectValueLabel (array $items)
    {
        $arr = [];
        foreach ($items as $value => $label) {
            $arr[] = [
                'value' => $value,
                'label' => $label
            ];
        }

        return $arr;
    }
}
