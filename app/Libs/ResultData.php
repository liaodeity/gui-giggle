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


use Illuminate\Database\Eloquent\Model;

/**
 * Class ResultData
 * @package App\Libs 数据返回结构
 */
class ResultData
{
    protected $error   = false;
    protected $message = '';
    protected $result  = null;
    protected $url     = '';

    /**
     * @param bool $error
     * @return ResultData
     */
    public function setError (bool $error): ResultData
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @param string $message
     * @return ResultData
     */
    public function setMessage (string $message): ResultData
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param null $result
     * @return ResultData
     */
    public function setResult ($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * 将数拼接
     * add by gui
     * @return array
     */
    public function toArray ()
    {
        $data = [
            'code'    => $this->isError () ? 1001 : 0,
            'message' => $this->getMessage (),
            'result'  => $this->getResult (),
            'url'     => $this->getUrl (),
        ];
        //dd ($data);
        //$data         = $this->getResult();
        //$data['msg']  = $this->getMessage();
        //$data['code'] = $this->isError() ? 1 : 0;

        return $data;
    }

    /**
     * @return bool
     */
    public function isError (): bool
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getMessage (): string
    {
        return $this->message;
    }

    /**
     * @return null
     */
    public function getResult ()
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getUrl (): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl (string $url): ResultData
    {
        $this->url = $url;

        return $this;
    }

}
