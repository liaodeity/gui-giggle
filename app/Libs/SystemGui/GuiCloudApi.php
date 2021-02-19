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


use App\Exceptions\SystemGuiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 建百站云api Class GuiApi
 * @package App\Libs\SystemGui
 */
class GuiCloudApi
{
    /**
     * 获取是否有更新版本信息 add by gui
     * @return array
     * @throws SystemGuiException
     */
    public function getVersionLog ()
    {

        $result = $this->post ('get-version-log', [
            'version' => config ('system_gui.version')
        ]);

        return $result;
    }

    /**
     * 获取官网的应用中心插件地址
     *  add by gui
     */
    public function getPluginWebSiteUrl ()
    {
        return $this->getApiUrl ('store');
    }

    protected function getApiUrl ($path_info)
    {
        return config ('system_gui.jbz_gui_api') . $path_info;
    }

    protected function getAccountToken ()
    {
        $result = $this->post ('get-account-token', [
            'app_id'     => $this->getAppId (),
            'secret_key' => $this->getSecretKey ()
        ], false);

        return $result['account_token'] ?? '';
    }

    protected function getAppId ()
    {
        return config ('system_gui.jbz_gui_app_id');
    }

    protected function getSecretKey ()
    {
        return config ('system_gui.jbz_gui_secret_key');
    }

    protected function getCache ($key)
    {

    }

    protected function setCache ($key, $value)
    {

    }


    /**
     *  add by gui
     * @param      $url
     * @param      $param
     * @param bool $token
     * @return array
     * @throws SystemGuiException
     */
    protected function post ($url, $param, $token = true)
    {
        $client = new  Client([
            'timeout' => 10
        ]);
        if ($token)
            $param['account_token'] = $this->getAccountToken ();
        try {
            $response = $client->request ('POST', $url, [
                'form_params' => $param
            ]);
        } catch (GuzzleException $e) {
            throw new SystemGuiException($e->getMessage ());
        }

        $result = $response->getBody ();
        if (!$result) {
            throw new SystemGuiException('访问远程接口失败');
        }
        $data = @json_decode ($result);
        if ($data->code === 0) {
            //成功
            return $data->result ?? [];
        } else {
            $msg = $data->msg ?? '';
            throw new SystemGuiException($msg);
        }
    }
}
