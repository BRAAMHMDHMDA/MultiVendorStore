<?php

namespace App\Models;

use App\Traits\GetImageUrl;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AD extends Model
{
    use GetImageUrl, HasImage;
    protected $table = 'ads';
    protected $fillable = ['main_title', 'sub_title', 'image_path', 'button_link', 'button_text', 'status'];
    public static string $imageDisk = 'media';
    public static string $imageFolder = '/ads';
    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    public function setMainTitleAttribute($value): void
    {
        $this->attributes['main_title'] = Str::title($value);
    }
    public function scopeActive(Builder $builder): void
    {
        $builder->where('status', '=', 'active');
    }
}
