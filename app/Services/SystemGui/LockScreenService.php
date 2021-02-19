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

namespace App\Services;

/**
 * add by gui
 * Class LockScreenService
 * @package App\Services
 */
class LockScreenService
{
    protected $type = '';

    /**
     * @param string $type
     */
    public function setType(string $type): LockScreenService
    {
        $this->type = $type;

        return $this;
    }

    protected function getSessionKey()
    {
        return $this->type . '_is_lock_screen';
    }

    /**
     * 设置锁屏
     */
    public function setLock()
    {
        session()->put($this->getSessionKey(), 1);
    }

    /**
     * 取消锁屏
     */
    public function cancelLock()
    {
        session()->put($this->getSessionKey(), 0);
    }


    /**
     * 检查是否锁屏
     *  add by gui
     * @return bool
     */
    public function checkIsLock()
    {
        $key = $this->getSessionKey();

        $check = session($key);
        return $check == 1 ? true : false;
    }
}
