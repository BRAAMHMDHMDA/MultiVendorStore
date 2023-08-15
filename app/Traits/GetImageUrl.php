<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GetImageUrl
{

    // Define a method to return the append attributes defined in the trait
    public function getTraitAppends(): array
    {
        return ['image_url'];
    }

    // Get Image Url
    public function getImageUrlAttribute(): string
    {
        if (!$this->image_path){
            return asset('storage/media/no-image.jpg');
        }elseif (Str::startsWith($this->image_path, ['http://', 'https://'])) {
            return $this->image_path;
        }else {
            return asset('storage/media/' . $this -> image_path);
        }
    }

    public function getArrayableAppends(): array
    {
        // Get the trait's $appends array
        $traitAppends = $this->getTraitAppends();

        // Get the parent's $appends array
        $parentAppends = parent::getArrayableAppends();

        // Merge the trait's $appends array with the parent's $appends array
        return array_merge($traitAppends, $parentAppends);
    }




}
