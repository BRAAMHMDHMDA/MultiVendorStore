<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $newArrivalsProducts = Product::active()->latest()->take(8)->get();
        $featuredProducts = Product::active()->featured()->latest()->take(8)->get();
        $categories = Category::active()->whereNull('parent_id')
                        ->withCount('products')
                        ->orderBy('products_count', 'desc')
                        ->with('children')->take(8)->get();

        return view('website.content.home',[
            'newArrivalsProducts' => $newArrivalsProducts,
            'featuredProducts' => $featuredProducts,
            'categories' => $categories
        ]);
    }
}
