<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\AD;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $newArrivalsProducts = Product::active()->latest()->take(8)->get();
        $featuredProducts = Product::active()->featured()->latest()->take(8)->get();
        $topCategories = Category::active()->whereNull('parent_id')
                        ->withCount('products')
                        ->orderBy('products_count', 'desc')
                        ->with('children')->take(8)->get();
        $ADs = AD::active()->inRandomOrder()->take(3)->get();
        $testimonials = Testimonial::showAtHome()->active()->inRandomOrder()->take(3)->get();
        $brands = Brand::select(['id', 'name','image_path'])->inRandomOrder()->take(8)->get();


        return view('website.content.home',[
            'newArrivalsProducts' => $newArrivalsProducts,
            'featuredProducts' => $featuredProducts,
            'topCategories' => $topCategories,
            'ADs' => $ADs,
            'testimonials' => $testimonials,
            'brands' => $brands
        ]);
    }
}
