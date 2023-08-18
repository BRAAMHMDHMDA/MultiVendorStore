<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Store;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $vendors = Vendor::latest()->paginate();
        return view('dashboard.content.vendors.index', [
            'vendors' => $vendors
        ]);
    }
    public function create()
    {
        $stores = Store::all();
        $vendor = new Vendor();
        return view('dashboard.content.vendors.create', compact('vendor', 'stores'));
    }

    public function store(VendorRequest $request)
    {
        Vendor::storeImage($request);

        // hashing password
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        Vendor::create($data);

        return Redirect::route('dashboard.vendors.index')
            ->with('success', 'Vendor created Successfully!');
    }

    public function edit(Vendor $vendor)
    {
        $stores = Store::all();

        return view('dashboard.content.vendors.edit', compact('vendor', 'stores'));
    }

    public function update(VendorRequest $request, Vendor $vendor)
    {
        Vendor::updateImage($request, $vendor->image_path);
        $data = $request->except('password');
        if(isset($request->password)){
            $data['password'] = Hash::make($request->password);
        }
        $vendor->update($data);

        return Redirect::route('dashboard.vendors.index')
            ->with('success', 'Vendor Updated Successfully!');
    }

    public function destroy(Vendor $vendor)
    {
        $store_name = $vendor->store->name;
        if (Store::find($vendor->store_id)->vendors()->count()===1)
        {
            return redirect()->route('dashboard.vendors.index')->with([
                'warning' => "($vendor->name) Last Vendor in ($store_name) Store,It Cannot be Deleted
                <br />You can Delete the Store and this Vendor will be deleted along with it"
            ]);
        }
        $vendor->delete();
        Vendor::deleteImage($vendor->image_path);

        return Redirect::route('dashboard.vendors.index')
            ->with('success', 'Vendor Deleted Successfully!');
    }

    public function setStatus(Vendor $vendor)
    {
        $store_name = $vendor->store->name;
        if (Store::find($vendor->store_id)->vendors()->count()===1)
        {
            return redirect()->route('dashboard.vendors.index')->with([
                'warning' => "($vendor->name) Last Vendor in ($store_name) Store,It Cannot be Banned
                <br />You can Ban the Store and this Vendor will be Banned along with it"
            ]);
        }

        $vendor->updateOrFail([
            'status' => ($vendor->status === 'active') ? 'inactive' : 'active',
        ]);

        return redirect()->route('dashboard.vendors.index');
    }
}
