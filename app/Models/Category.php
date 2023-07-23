<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
  use HasFactory;

  protected $fillable = ['name','slug','description','parent_id','status','image'];
  protected $guarded = ['id'];

    public function setNameAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['name'] = Str::title($value);
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

    public function children() {
        return $this->hasMany(Category::class);
    }

}
