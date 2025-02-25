<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::active()
            ->when($request->search, function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request -> search . '%');
            })
            ->when($request->min_price, function ($q) use ($request) {
                return $q->where('price', '>=', $request->min_price);
            })
            ->when($request->max_price, function ($q) use ($request) {
                return $q->where('price', '<=', $request->max_price);
            })
            ->when($request->category, function ($q) use ($request) {
                return $q->whereHas('category', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->category . '%');
                });
            })->paginate(12);

        return view('website.content.all-product', [
            'products' => $products,
            'categories' => Category::withCount('products')->get(),
            'minPrice' => Product::min('price'),
            'maxPrice' => Product::max('price'),

        ]);
    }

    public function show(Product $product)
    {
        if (!$product -> status == Product::STATUS_ACTIVE) {
            abort(403);
        }
        return view('website.content.product-details', ['product' => $product]);
    }


    public function search(Request $request)
    {
        $products = Product::active()
            ->when($request->search, function ($q) use ($request) {
                return $q->where('name', 'like', '%' . $request -> search . '%');
            })
            ->paginate(12);
        return view('website.content.search-page', [
            'products' => $products,
        ]);
    }
//    public function index()
//    {
//        if (request()->ajax()){
//            return Movie::published()->where('name', 'LIKE', '%'. request()->search .'%')->get();
//        }
//        abort(404);
//    }
}
