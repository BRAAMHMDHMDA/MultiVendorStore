<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function index()
    {
        $stores = Store::paginate(10);

//        dd($stores);
        return view('website.content.stores', ['stores' => $stores]);
    }

    public function show(Store $store)
    {
        if (!$store->status == 'active') {
            abort(403);
        }
        return view('website.content.store-details', ['store' => $store]);
    }

}