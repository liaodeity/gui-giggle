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

namespace App\Addons\PublicImage\Repositories;

use App\Addons\PublicImage\Models\Image;
use App\Addons\PublicImage\Repositories\Interfaces\ImageInterface;
use App\Repositories\BaseRepository;
use App\Addons\PublicImage\Validators\ImageValidator;
/**
 * Class ImageRepository.
 * @package namespace App\Addons\PublicImage\Repositories;
 */
class ImageRepository extends BaseRepository implements ImageInterface
{
    /**
     * Specify Model class name
     * @return string
     */
    public function model()
    {
        return Image::class;
    }

    public function boot()
    {
        return true;
    }

    public function validator()
    {
        return ImageValidator::class;
    }
    /**
     * @param Image $image
     * @return boolean;
     */
    public function allowDelete(Image $image)
    {
        return true;
    }
}
