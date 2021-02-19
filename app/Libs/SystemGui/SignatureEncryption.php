<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( MIT )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2020 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: 廖春贵 < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

namespace App\Libs\SystemGui;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * 签名加密类
 * Class SignatureEncryption
 * @package App\Libs\SystemGui
 */
class SignatureEncryption
{
    private $appId     = null;
    private $secretKey = null;
    private $timestamp = null;
    private $nonceStr  = null;

    public function __construct ()
    {
        $this->appId     = config ('system_gui.jbz_gui_app_id');
        $this->secretKey = config ('system_gui.jbz_gui_secret_key');

    }

    public function getParseParams ($arr)
    {
        $this->timestamp = time ();
        $this->nonceStr  = uniqid (true);

        $arr['timestamp'] = $this->timestamp;
        $arr['noncestr']  = $this->nonceStr;
        $arr['sign']      = $this->generateSign ($arr);

        return $arr;
    }

    /**
     * 检查签名 add by gui
     * @param array $request
     * @return bool
     */
    public function checkSign (array $request)
    {
        $sign = array_get ($request, 'sign');
        unset($request['sign']);
        $currentSign = $this->generateSign ($request);
        if ($sign === $currentSign) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 生成秘钥 add by gui
     * @param array $arr
     * @return string
     */
    protected function generateSign (array $arr)
    {
        $arr['appid']      = $this->appId;
        $arr['secret_key'] = $this->secretKey;
        ksort ($arr);
        foreach ($arr as $key => $item) {
            $sign[] = $key . '=' . $item;
        }
        $str = implode ('&', $sign);

        return sha1 ($str);
    }

}
