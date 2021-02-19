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
//用户自行函数库,可定义自行的函数


/**
 *    根据输入的周数获取到该周的日期范围【推荐使用】
 *    从周一到周日算是一周
 *
 *    @author    _DT_Baby
 *    @param     int $year    年份
 *    @param     int $weeknum    周数
 *    @return array
 */
function get_week_date($year,$weeknum)
{
    $firstdayofyear = mktime (0, 0, 0, 1, 1, $year);
    $firstweekday   = date ('N', $firstdayofyear); //星期数
    $firstweenum    = date ('W', $firstdayofyear); //周数
    if (intval ($firstweenum) == 1) {
        $day = (1 - ($firstweekday - 1)) + 7 * ($weeknum - 1);
    } else {
        $day = (9 - $firstweekday) + 7 * ($weeknum - 1);
    }
    $startdate = date ('Y-m-d', mktime (0, 0, 0, 1, $day, $year));
    $enddate   = date ('Y-m-d', mktime (0, 0, 0, 1, $day + 6, $year));

    return array($startdate, $enddate);
}
