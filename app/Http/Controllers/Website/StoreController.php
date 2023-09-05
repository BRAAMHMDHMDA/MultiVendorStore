<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function index(Request $request)
    {

        $stores = Store::active()
            ->when($request -> search, function ($q) use ($request) {
                return $q -> where('name', 'like', '%' . $request -> search . '%');
            })
            ->with('owner')
            ->withCount('products')
            ->paginate(4);

        return view('website.content.stores', ['stores' => $stores]);
    }

    public function show(Store $store)
    {
        if (!$store -> status == 'active') {
            abort(403);
        }

        $products = $store->products()->paginate(12); // Change the number per page as needed

        return view('website.content.store-details', ['store' => $store, 'products' => $products]);
    }

}