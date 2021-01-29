<?php
/*
|-----------------------------------------------------------------------------------------------------------
| gui-giggle [ 简单高效的开发插件系统 ]
|-----------------------------------------------------------------------------------------------------------
| Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
| ----------------------------------------------------------------------------------------------------------
| Copyright (c) 2014-2021 https://github.com/liaodeity/gui-giggle All rights reserved.
| ----------------------------------------------------------------------------------------------------------
| Author: Gui < liaodeity@gmail.com >
|-----------------------------------------------------------------------------------------------------------
*/

namespace App\Addons\Attachment\Repositories\Interfaces;


use App\Addons\Attachment\Models\Attachment;
use App\Repositories\BaseInterface;

interface AttachmentInterface extends BaseInterface
{
    /**
     * @param Attachment $attachment
     * @return boolean;
     */
    public function allowDelete (Attachment $attachment);
}
