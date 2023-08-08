<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::paginate(12);
        return view('website.content.all-product',['products' => $products]);
    }

    public function show(Product $product)
    {
        if (!$product->status == Product::STATUS_ACTIVE) {
            abort(403);
        }
        return view('website.content.product-details', ['product' => $product]);
    }

}
