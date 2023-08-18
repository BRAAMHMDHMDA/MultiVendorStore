<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        // vendors count
        $stores = Store::with('owner:store_id,name')->withCount('vendors')->latest()->paginate();
        return view('dashboard.content.stores.index', [
            'stores' => $stores
        ]);
    }

    public function show(Store $store)
    {
        //
    }
    public function create()
    {
        $store = new Store();
        return view('dashboard.content.stores.create', compact('store'));
    }

    public function store(StoreRequest $request)
    {
//        $request->dd();
        // Create Store
        DB::beginTransaction();
        try {
        Store::storeImage($request, 'c_image', 'cover_image');
        Store::storeImage($request, 'l_image', 'logo_image');

        $store = Store::create($request->all());
//        dd($store);

        // Create Owner
        Vendor::storeImage($request, 'vendor_image');
        Vendor::create([
            'name' => $request->post('vendor_name'),
            'email'=> $request->post('vendor_email'),
            'username'=> $request->post('vendor_username'),
            'password'=> Hash::make($request->post('vendor_password')),
            'phone_number'=> $request->post('vendor_phone_number'),
            'image_path'=> $request->post('image_path'),
            'status'=> 'active',
            'store_id'=> $store->id,
        ]);

        DB::commit();

        return Redirect::route('dashboard.stores.index')
            ->with('success', 'Store created Successfully!');

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(Store $store)
    {
        return view('dashboard.content.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, Store $store)
    {
        Store::updateImage($request, $store->cover_image,'c_image', 'cover_image');
        Store::updateImage($request, $store->logo_image,'l_image', 'logo_image');

        $store->update($request->all());

        return Redirect::route('dashboard.stores.index')
            ->with('success', 'Store Updated Successfully!');
    }

    public function destroy(Store $store)
    {
        $store->delete();
        Store::deleteImage($store->logo_image);
        Store::deleteImage($store->cover_image);
        $store->vendors()->delete();

        return Redirect::route('dashboard.stores.index')
            ->with('success', 'Store & All Store Vendors Deleted Successfully!');
    }

    public function setStatus(Store $store)
    {
        $store->updateOrFail([
            'status' => ($store->status === 'active') ? 'inactive' : 'active',
        ]);

        return redirect()->route('dashboard.stores.index');
    }
}
