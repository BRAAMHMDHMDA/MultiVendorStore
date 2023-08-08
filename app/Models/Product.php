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
        'name', 'slug', 'description', 'image', 'featured',
        'price', 'compare_price', 'status', 'quantity',
        'category_id', 'store_id', 'brand_id'
    ];
    protected $guarded = ['id'];
    protected $appends = ['format_price', 'format_compare_price'];
    public function setNameAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['name'] = Str::title($value);
        $this->attributes['store_id'] = 1;
    }
    public function getFormatPriceAttribute()
    {
        return Currency::format($this->price);
    }
    public function getFormatComparePriceAttribute()
    {
        return Currency::format($this->compare_price);
    }
    public function  getSalePercentageAttribute(){
        if (!$this->compare_price){
            return 0;
        }
        return number_format(100-( 100 * $this->price/$this->compare_price ), 1);
    }

    public function getNewAttribute()
    {
        $createdAt = Carbon::parse($this->attributes['created_at']);
        $now = Carbon::now();

        // Check if the difference is less than or equal to 3 days
        return $createdAt->diffInDays($now) <= 3;
    }
    protected static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder){
            $user = Auth::user();
            if ($user && $user->store_id) {
                $builder->where('store_id', '=', $user->store_id);
            }
        });
    }
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }
    public function scopeFeatured(Builder $builder)
    {
        $builder->where('featured', '=', '1');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => '-'
        ]);
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
            ->addColumn('image', function ($product) {
                return $img = '<img src="'.asset($product->image_url).'" class="thumbnail me-2" width="40">';
            })
            ->addColumn('action',  function ($row) use ($is_trash) {
                // Render the action_buttons view and pass the 'id' data
                return view('dashboard.content.products.action_buttons', ['id' => $row->id] , ['is_trash' => $is_trash])->render();
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }

}
