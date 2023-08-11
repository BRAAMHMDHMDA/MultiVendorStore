<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

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
}
