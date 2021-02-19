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
namespace App\Exceptions;

use Exception;

/**
 * 权限验证异常类
 * Class PermissionCheckException add by gui
 * @package App\Exceptions
 */
class PermissionCheckException extends Exception
{
    ///**
    // * Report or log an exception.
    // *
    // * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
    // *
    // * @param  \Exception  $e
    // * @return void
    // */
    //public function report(Exception $e)
    //{
    //    return parent::report($e);
    //}
    /**
     * 将异常转换为 HTTP 响应。
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function render ($request)
    {
        if ($request->wantsJson ()) {
            return ajax_error_message ($this->getMessage ());
        } else {
            //dd($this->getMessage ());
            abort (403, $this->getMessage ());
        }
    }

}
