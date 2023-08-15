<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait HasImage
{

    public static function storeImage(Request $requset)
    {
        if ($requset->hasFile('image') && $requset->file('image')->isValid()){
            $image = $requset->file('image');
            $image_path = $image->store(static::$imageFolder, static::$imageDisk);
            $requset->merge(['image_path' => $image_path]);
            return true;
        }
        return false;
    }

    public static function updateImage(Request $requset, $oldImage)
    {
        $newImage = static::storeImage($requset);
        if ($newImage) {
            static::deleteImage($oldImage);
            return $newImage;
        }
        return $oldImage;
    }

    public static function deleteImage($image_path)
    {
        if (!$image_path) return true;
        return Storage::disk(static::$imageDisk)->delete($image_path);
    }
}
