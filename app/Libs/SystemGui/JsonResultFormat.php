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


class JsonResultFormat
{
    private $code   = null;
    private $msg    = null;
    private $result = null;

    /**
     * 解析json add by gui
     * @param $json
     * @return JsonResultFormat
     */
    public function format ($json): JsonResultFormat
    {
        $arr          = json_decode ($json, true);
        $this->code   = array_get ($arr, 'code');
        $this->msg    = array_get ($arr, 'msg');
        $this->result = array_get ($arr, 'result', []);

        return $this;
    }

    /**
     * 是否成功 add by gui
     * @return bool
     */
    public function isSuccess ()
    {
        if ($this->getCode () === 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 是否失败 add by gui
     * @return bool
     */
    public function isFail ()
    {
        if ($this->getCode () === 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 获取状态码
     * @return null
     */
    public function getCode ()
    {
        return $this->code;
    }

    /**
     * 获取说明文字
     * @return null
     */
    public function getMsg ()
    {
        return $this->msg;
    }

    /**
     * 获取结果数据
     * @param null $key
     * @param null $default
     * @return null
     */
    public function getResult ($key = null, $default = null)
    {
        if (is_null ($key)) {
            return $this->result;
        }

        return array_get ($this->result, $key, $default);
    }
}
