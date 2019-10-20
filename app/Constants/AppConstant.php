<?php

namespace App\Constants;

/**
 * Class App
 *
 * @package App\Constants
 */
class AppConstant
{
    /**
     * @var string
     */
    const MIME_TYPE_IMAGE = 'jpg,jpeg,png,gif,bmp,tif';

    /**
     * @var string
     */
    const MIME_TYPE_FILE = 'jpg,jpeg,png,gif,bmp,tif,rar,zip';

    /**
     * @var int
     */
    const IMAGE_MAXSIZE = 10240; // kb

    /**
     * @var int
     */
    const FILE_MAXSIZE = 10240; // kb
}
