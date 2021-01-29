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


use Illuminate\Support\Facades\DB;

class QueryWhere
{
    protected static $request = [];

    //request
    //private static $orderField = null;
    private static $orderBy = null;
    //设置默认的排序方式
    //public static function defaultOrderBy ($field = null, $order = null)
    //{
    //    if (empty (self::$orderField) && $field) {
    //        self::$orderField = $field;
    //    }
    //    if ($order) {
    //        self::$order = $order;
    //    }
    //
    //    return new self;
    //}

    public static function setRequest ($request = null): QueryWhere
    {
        $request = request ()->all ();
        if (array_get ($request, 'order_by')) {

            $order_by = array_get ($request, 'order_by');
            list($order, $by) = explode (' ', $order_by);
            switch (strtolower ($by)) {
                case 'asc':
                case 'desc':
                    self::$orderBy = $order_by;
                    break;
            }
        }
        self::$request = $request;
        debug_log ('接收解析参数', $request);

        return new self;
    }

    protected static function getRequestValue ($field)
    {
        $val = array_get (self::$request, $field);
        if (is_null ($val) && strstr ($field, '.')) {
            list($tab, $key) = explode ('.', $field);
            if ($key) {
                $val = isset(self::$request[ $key ]) ? self::$request[ $key ] : null;
            }
        }

        return $val;
    }

    //select *
    public static function select (&$M, $val)
    {
        $M = $M->select ($val);
    }

    //where =?
    public static function eq (&$M, $field, $val = null)
    {
        if (is_null ($val)) {
            $val = self::getRequestValue ($field);
        }
        if ($val != '')
            $M = $M->where ($field, $val);
    }

    //where in(?)
    public static function in (&$M, $field, $val = [])
    {
        if (!empty($val)) {
            $M = $M->whereIn ($field, $val);
        }
    }

    //wehre not in(?)
    public static function notIn (&$M, $field, $val = [])
    {
        if (!empty($val)) {
            $M = $M->whereNotIn ($field, $val);
        }
    }

    //where like '%?%'
    public static function like (&$M, $field, $val = null)
    {
        if (is_null ($val)) {
            $val = self::getRequestValue ($field);
        }
        if ($val != '')
            $M = $M->where ($field, 'like', "%$val%");
    }

    //region where '%||%'
    public static function region (&$M, $field, $val = null)
    {
        if (is_null ($val)) {
            $val = self::getRequestValue ($field);
        }
        if ($val != '')
            $M = $M->where ($field, 'like', "%|$val|%");
    }

    // where date>=? and date<=?
    public static function date (&$M, $field, $s_val = null, $e_val = null)
    {
        if (is_null ($s_val)) {
            $s_val = self::getRequestValue ($field . '_start');
        }
        if (is_null ($e_val)) {
            $e_val = self::getRequestValue ($field . '_end');
        }
        if ($s_val) $M = $M->where ($field, '>=', $s_val . ' 00:00:00');
        if ($e_val) $M = $M->where ($field, '<=', $e_val . ' 23:59:59');
    }

    //where time>=? and time<=?
    public static function time (&$M, $field, $s_val, $e_val)
    {
        if (is_null ($s_val)) {
            $s_val = self::getRequestValue ($field . '_start');
        }

        if (is_null ($e_val)) {
            $e_val = self::getRequestValue ($field . '_end');
        }

        if ($s_val) $M = $M->where ($field, '>=', $s_val);
        if ($e_val) $M = $M->where ($field, '<=', $e_val);
    }

    //order by ?
    public static function orderBy (&$M, $orderBy = null)
    {

        if (!is_null (self::$orderBy)) {
            $orderBy = self::$orderBy;
        }

        list($order, $by) = explode (' ', $orderBy);
        $by = str_replace ('ending', '', $by);
        $order = trim($order, '_');
        $M  = $M->orderBy ($order, $by);
    }
}
