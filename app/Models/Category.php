<?php

namespace App\Models;

use App\Traits\GetImageUrl;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * @method static latest()
 * @method static create(array $data)
 */
class Category extends Model
{
  use HasFactory, GetImageUrl, HasImage;

  protected $fillable = ['name','slug','description','parent_id','status','image_path'];
  protected $guarded = ['id'];
  protected $withCount = ['products'];
    public static string $imageDisk = 'media';
    public static string $imageFolder = '/categories';

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function () {
            Cache::forget('categories_list');
        });

        static::updating(function () {
            Cache::forget('categories_list');
        });

        static::deleting(function () {
            Cache::forget('categories_list');
        });
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['name'] = Str::title($value);
    }
    public function scopeActive(Builder $builder): void
    {
        $builder->where('status', '=', 'active');
    }

    public function products() {
          return $this->hasMany(Product::class);
      }

    public function parent() {
        return $this->belongsTo(Category::class)
            ->withDefault([
                'name' => '-'
            ]);
    }

    public function children()
    {
        return $this->hasMany(Category::class , 'parent_id')->with('children');
    }

}
