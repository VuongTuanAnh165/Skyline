<?php

namespace App\Helpers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadsHelper
{
    /**
     * Get File Extension
     * @param $name
     * @param $request
     * @return string
     */
    public static function getFileExtension($name, $request)
    {
        if (!$request->hasFile($name)) {
            return '';
        }

        $image = $request->file($name);
        return $image->getClientOriginalExtension();
    }


    /**
     * Upload Origin File
     * @param $image
     * @param $uploadPath
     * @param $name
     * @param $request
     * @return string
     */
    public static function uploadFileOrigin($image, $uploadPath, $name, $request)
    {
        if (!$request->hasFile($name)) {
            return '';
        }

        $imageName = $image->getClientOriginalName();
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $image->move($uploadPath, $imageName);
        return '/' . $uploadPath . $imageName;
    }

    /**
     * Get Origin File
     * @param $name
     * @param $uploadPath
     * @param $request
     * @return string
     */
    public static function getOriginFile($name, $uploadPath, $request)
    {
        if (!$request->hasFile($name)) {
            return '';
        }

        $file = $request->file($name);
        return self::uploadFileOrigin($file, $uploadPath, $name, $request);
    }

    /**
     * Handle Upload Image
     * @param string $uploadPath
     * @param $name
     * @param $request
     * @return string
     */
    public static function handleUploadFile($uploadPath, $name, $request)
    {
        $fullPath = '';
        if (!$request->hasFile($name)) {
            return $fullPath;
        }

        $file = $request->file($name);
        $saveName = $file->hashName();
        $fullPath = $uploadPath . $saveName;
        if (!Storage::disk()->exists($uploadPath)) {
            Storage::disk()->makeDirectory($uploadPath);
        }
        Storage::disk()->put($fullPath, file_get_contents($file));
        return $fullPath;
    }

    /**
     * Handle Remove Image
     * @param string $uploadPath
     * @param $name
     * @param $request
     * @return string
     */
    public static function handleRemoveFile($uploadPath, $name, $request)
    {
        $fullPath = '';
        if (!$request->hasFile($name)) {
            return $fullPath;
        }

        $fileDelete = $request->get($name);
        $fullPath = $uploadPath . $fileDelete;
        if (Storage::disk()->exists($fullPath)) {
            Storage::disk()->delete($fullPath);
        }
        return $fullPath;
    }

    /**
     * Handle Remove file
     * @param $name
     * @param $request
     * @return string
     */
    public static function handleDeleteFile($name, $request)
    {
        $fileDelete = $request->get($name);
        if (Storage::disk()->exists($fileDelete)) {
            Storage::disk()->delete($fileDelete);
        }
        return $fileDelete;
    }
}
