<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MyStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('storeOwner');
    }

    public function edit()
    {
        $store = Store::find(Auth::user()->store_id);
        return view('dashboard.content.pages.my-store', compact('store'));
    }

    public function update(StoreRequest $request, Store $store)
    {
        Store::updateImage($request, $store->cover_image,'c_image', 'cover_image');
        Store::updateImage($request, $store->logo_image,'l_image', 'logo_image');

        Store::find(Auth::user()->store_id)->update($request->all());

        return Redirect::route('dashboard.my-store')
            ->with('success', 'Store Info Updated Successfully!');
    }
}
