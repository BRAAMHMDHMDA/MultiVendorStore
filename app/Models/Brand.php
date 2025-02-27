<?php

namespace App\Models;

use App\Traits\GetImageUrl;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Brand extends Model
{
    use GetImageUrl, HasImage;
    public static string $imageDisk = 'media';
    public static string $imageFolder = '/brands';

    protected $fillable = ['name', 'slug', 'image_path'];

    public function setNameAttribute($value): void
    {
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['name'] = Str::title($value);
    }

    public function scopeActive(Builder $builder): void
    {
        $builder->where('status', '=', 'active');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
