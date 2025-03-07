<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImage
{

    public static function storeImage($request, $name_image_in_request='image', $name_image_in_DB='image_path')
    {
        if ($request->hasFile($name_image_in_request) && $request->file($name_image_in_request)->isValid()){
            $image = $request->file($name_image_in_request);
            $image_path = $image->store(static::$imageFolder, static::$imageDisk);
            $request->merge([$name_image_in_DB => $image_path]);
            return true;
        }
        return false;
    }

    public static function updateImage($request, $oldImage, $name_image_in_request='image', $name_image_in_DB='image_path')
    {
        $newImage = static::storeImage($request, $name_image_in_request, $name_image_in_DB);
        if ($newImage) {
            static::deleteImage($oldImage);
            return $newImage;
        }
        return $oldImage;
    }

    public static function deleteImage($image_path): bool
    {
        if (!$image_path || $image_path == 'default.jpg') return true;
        return Storage::disk(static::$imageDisk)->delete($image_path);
    }
}
