<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static create(array $all)
 * @method static latest()
 */
class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    public function setNameAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['name'] = Str::title($value);
    }

    public function scopeActive(Builder $builder): void
    {
        $builder->where('status', '=', 'active');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
