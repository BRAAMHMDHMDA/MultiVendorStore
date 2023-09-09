<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class wishlist extends Model
{
    protected $table = 'wishlists';
    public $timestamps = false;
    public $incrementing = false;
    protected $with = ['product'];

    protected $fillable = ['cookie_id', 'user_id', 'product_id'];

    protected static function booted()
    {
        static::addGlobalScope('cookie_id', function(Builder $builder) {
            $builder->where('cookie_id', '=', wishlist::getCookieId());
        });

        static::creating(function(wishlist $wishlist) {
            $wishlist->id = Str::uuid();
            $wishlist->cookie_id = wishlist::getCookieId();
            $wishlist->user_id = Auth::user()?->id;
        });
    }

    public static function getCookieId(): string
    {
        $cookie_id = Cookie::get('wishlist_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('wishlist_id', $cookie_id, 30 * 24 * 60);
        }
        return $cookie_id;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous',
        ]);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
