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

namespace App\Addons\Attachment\Repositories;

use App\Addons\Attachment\Models\Attachment;
use App\Addons\Attachment\Repositories\Interfaces\AttachmentInterface;
use App\Repositories\BaseRepository;
use App\Addons\Attachment\Validators\AttachmentValidator;
/**
 * Class AttachmentRepository.
 * @package namespace App\Addons\Attachment\Repositories;
 */
class AttachmentRepository extends BaseRepository implements AttachmentInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Attachment::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return AttachmentValidator::class;
    }
    /**
     * @param Attachment $attachment
     * @return boolean;
     */
    public function allowDelete(Attachment $attachment)
    {
        return true;
    }
}
