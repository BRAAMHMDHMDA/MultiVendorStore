<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomePage extends Controller
{
      public function index()
      {
            $newArrivalsProducts = Product::active()->latest()->take(8)->get();
            $featuredProducts = Product::active()->featured()->latest()->take(8)->get();
            $categories = Category::whereNull('parent_id')->with('children')->get();

            return view('website.content.home',[
                'newArrivalsProducts' => $newArrivalsProducts,
                'featuredProducts' => $featuredProducts,
                'categories' => $categories
            ]);
      }

}
