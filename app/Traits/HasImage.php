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
            return $image->store(static::$imageFolder, static::$imageDisk);
        }else return false;
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

    public static function deleteImage($image)
    {
        if (!$image) return true;
        return Storage::disk(static::$imageDisk)->delete($image);
    }
}
