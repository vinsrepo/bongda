<?php

namespace App\Services\Upload;

use App\Components\Filesystem\Filesystem;
use App\Constants\DirectoryConstant;
use App\Constants\SettingUser;
use App\Constants\Directory;
use App\Models\Image;

/**
 * Class UploadService
 *
 * @package App\Services\Upload
 */
class UploadService
{
    /**
     * @var Filesystem
     */
    private $fileUpload;

    /**
     * UploadService constructor.
     *
     * @param Filesystem $fileUpload
     */
    public function __construct(Filesystem $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }

    /**
     * @param $path , $file
     *
     * @return array $images
     */
    public function uploadImage($path, $file)
    {
        $images = $this->fileUpload->uploadImage($path, $file);

        return $images;
    }

    /**
     * @param $path , $file
     *
     * @return array $file
     */
    public function uploadFiles($path, $file)
    {
        $files = $this->fileUpload->uploadFile($path, $file);

        return $files;
    }

    /**
     * @param $path
     *
     * @return bool
     */
    public function removeImage($path)
    {
        $remove = $this->fileUpload->remove($path);

        return $remove;
    }

    /**
     * @param \Illuminate\Http\UploadedFile $files
     *
     * @return array
     */
    public function uploadImageTemp($files)
    {
        $images = $this->fileUpload->uploadTemp($files);
        return $images;
    }

    /**
     * @param string $path
     * @param string $url
     *
     * @return array
     */
    public function moveImage($path, $url)
    {
        $images = $this->fileUpload->moveTempUpload($path, $url);
        return $images;
    }

    /**
     * @param \Illuminate\Http\UploadedFile[] $files
     *
     * @return array
     */
    public function image($files)
    {
        $images = $this->fileUpload->uploadTemp($files);
        $images = is_array($images) ? $images : [];

        return array_map(function ($img) {
            return url($img);
        }, $images);
    }
}
