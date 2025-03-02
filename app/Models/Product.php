<?php

namespace App\Models;

use App\Helpers\Currency;
use App\Traits\GetImageUrl;
use App\Traits\HasImage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

/**
 * @method static latest()
 * @method static active()
 */
class Product extends Model
{
    use HasFactory, SoftDeletes, GetImageUrl, HasImage;

    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';
    public static string $imageDisk = 'media';
    public static string $imageFolder = '/products/main';

    protected $fillable =[
        'name', 'slug', 'description', 'image_path', 'featured',
        'price', 'compare_price', 'status', 'quantity',
        'category_id', 'store_id', 'brand_id','created_by'
    ];
    protected $guarded = ['id'];
    protected $appends = ['format_price', 'format_compare_price'];
    protected $with = ['category', 'brand', 'store'];
    public function setNameAttribute($value): void
    {
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['name'] = Str::title($value);
    }
    public function getFormatPriceAttribute(): bool|string
    {
        return Currency::format($this->price);
    }
    public function getFormatComparePriceAttribute(): bool|string
    {
        return Currency::format($this->compare_price);
    }
    public function  getSalePercentageAttribute(): int|string
    {
        if (!$this->compare_price){
            return 0;
        }
        return number_format(100-( 100 * $this->price/$this->compare_price ), 1);
    }

    public function getNewAttribute(): bool
    {
        $createdAt = Carbon::parse($this->attributes['created_at']);
        $now = Carbon::now();

        // Check if the difference is less than or equal to 3 days
        return $createdAt->diffInDays($now) <= 3;
    }
    protected static function booted(): void
    {

        static::creating(function ($product) {
            $product->store_id = Auth::guard('vendors')->user()->store_id;
            $product->created_by = Auth::guard('vendors')->user()->id;
        });

        static::addGlobalScope('store', function (Builder $builder){
            $user = Auth::user();
            if ($user && $user->store_id) {
                $builder->where('store_id', '=', $user->store_id);
            }
        });
    }
    public function scopeActive(Builder $builder): void
    {
        $builder->where('status', '=', 'active')->whereHas('store', function ($query) {
            $query->where('status', '=', 'active');
        });
    }
    public function scopeFeatured(Builder $builder): void
    {
        $builder->where('featured', '=', '1');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => '-'
        ]);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
    // Add the isFav attribute as an accessor
//    public function getIsFavAttribute(): bool
//    {
//        $wishlistQuery = wishlist::query();
//
//        if (Auth::guard('web')->check()) {
//            return $wishlistQuery->where('product_id', $this->id)
//                ->where('user_id', Auth::id())
//                ->orWhere('cookie_id', wishlist::getCookieId())
//                ->exists();
//        } else {
//            return $wishlistQuery->where('product_id', $this->id)
//                ->where('cookie_id', wishlist::getCookieId())
//                ->exists();
//        }
//    }
//    public function getIsFavAttribute(): bool
//    {
//        $query = $this->users();
//
//        if (Auth::check()) {
//            // Check if the authenticated user's ID exists in the wishlist
//            return $query->where('user_id', Auth::id())->orWhere('cookie_id', $cookieId)->exists();
//        } else {
//            // Check if the product is in the wishlist based on the cookie_id
//            $cookieId = wishlist::getCookieId();
//            return $cookieId && $query->where('cookie_id', $cookieId)->exists();
//        }
//    }
    public function getIsFavAttribute(): bool
    {
        $userId = Auth::id();
        $cookieId = wishlist::getCookieId();

        return \DB::table('wishlists')
            ->where('product_id', $this->id)
            ->where(function ($query) use ($userId, $cookieId) {
                $query->when($userId, fn($q) => $q->where('user_id', $userId))
                    ->when($cookieId, fn($q) => $q->orWhere('cookie_id', $cookieId));
            })
            ->exists();
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public static function get_datatable($query, $is_trash=false): \Illuminate\Http\JsonResponse
    {
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('name', function ($product) {
                $img = '<img src="'.asset($product->image_url).'" class="thumbnail me-2" width="40">';
                $name = $img . "<span> $product->name </span>";
                return $name;
            })
            ->addColumn('action',  function ($row) use ($is_trash) {
                // Render the action_buttons view and pass the 'id' data
                return view('dashboard.content.products.action_buttons', ['id' => $row->id] , ['is_trash' => $is_trash])->render();
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
//                return $row->created_at->format('Y-m-d H:i');
            })
            ->rawColumns(['image', 'action','name'])
            ->make(true);
    }

    //scope
    public function scopeWhenCategoryId($query, $categoryId)
    {
        return $query->when($categoryId, function ($q) use ($categoryId) {

            return $q->whereHas('categories', function ($qu) use ($categoryId) {

                return $qu->where('category.id', $categoryId);

            });

        });

    }// end of scopeWhenGenreId




}
