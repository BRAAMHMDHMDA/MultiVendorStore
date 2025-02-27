<?php

namespace App\Models;

use App\Traits\GetImageUrl;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    use GetImageUrl, HasImage;
    protected $fillable = [
        'name', 'image_path', 'content', 'job_title', 'show_at_home', 'status',
    ];
    public static string $imageDisk = 'media';
    public static string $imageFolder = '/testimonials';
    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = Str::title($value);
    }
    public function scopeActive(Builder $builder): void
    {
        $builder->where('status', '=', 'active');
    }

    public function scopeShowAtHome(Builder $builder): void
    {
        $builder->where('show_at_home', '=', 1);
    }
}
