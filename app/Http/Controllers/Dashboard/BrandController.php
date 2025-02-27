<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index');
    }
    public function index()
    {
        return view('dashboard.content.brands.index')->with([
            'brands' => brand::latest()->paginate(10),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:brands|min:2|max:20']);

        Brand::storeImage($request);
        Brand::create($request->all());

        return redirect()->route('dashboard.brands.index')->with([
            'success' => "($request->name) brand Created Successfully"
        ]);
    }

    public function update(Request $request, brand $brand)
    {
        $request->validate(['name' => 'required',Rule::unique('brands','name')->ignore($brand->id)]);
        Brand::updateImage($request, $brand->image_path);

        $brand->update($request->all());

        return redirect()->route('dashboard.brands.index')->with([
            'success' => "($request->name) brand Updated Successfully"
        ]);
    }

    public function destroy(brand $brand)
    {
        if ($brand->products()->count())
        {
            return redirect()->route('dashboard.brands.index')->with([
                'warning' => "($brand->name) brand Linked with Products, First Must Delete Linked Products"
            ]);
        }

        Brand::deleteImage($brand->image_path);
        $brand->delete();
        return redirect()->route('dashboard.brands.index')->with([
            'success' => "($brand->name) brand Deleted Sucessfully"
        ]);
    }
}
