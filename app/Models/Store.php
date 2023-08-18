<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Store extends Model
{
    use HasFactory,HasImage;
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'description',
        'logo_image',
        'cover_image',
        'status',
    ];
    protected $appends = ['logo_image_url', 'cover_image_url'];
    public static string $imageDisk = 'media';
    public static string $imageFolder = '/stores';

    public function setNameAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['name'] = Str::title($value);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }
    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class);
    }
    public function owner(): HasOne
    {
        return $this->hasOne(Vendor::class)->orderBy('created_at', 'asc');
    }

    public function scopeActive(Builder $builder): void
    {
        $builder->where('status', '=', 'active');
    }

    // Get Logo Image Url
    public function getLogoImageUrlAttribute(): string
    {
        if (!$this->logo_image){
            return asset('storage/media/no-image.jpg');
        }elseif (Str::startsWith($this->logo_image, ['http://', 'https://'])) {
            return $this->logo_image;
        }else {
            return asset('storage/media/' . $this->logo_image);
        }
    }

    // Get Cover Image Url
    public function getCoverImageUrlAttribute(): string
    {
        if (!$this->cover_image){
            return asset('storage/media/no-image.jpg');
        }elseif (Str::startsWith($this->cover_image, ['http://', 'https://'])) {
            return $this->cover_image;
        }else {
            return asset('storage/media/' . $this->cover_image);
        }
    }

}
