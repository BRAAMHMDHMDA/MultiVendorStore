<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{


    public function data()
    {
        $data = Product::with('category:id,name')->with('store:id,name')->latest();
        return  DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function ($product) {
                return $img = ' <img src="'.$product->image.'" alt="'.$product->name.' Thumbnail" class="thumbnail me-2" width="40">
                                <span>'.$product->name.'</span>
                              ';
            })
            ->addColumn('action', function ($row) {
                return $btn = '
                    <a href="' . Route('dashboard.products.edit', $row->id) . '"  class="edit btn btn-outline btn-sm" ><i class="fa fa-edit "></i></a>
                    <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-outline btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash-can text-danger" ></i></a>';
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }


    public function index()
    {
        return view('dashboard.content.products.index');
    }


    public function create()
    {
        $categories = Category::latest()->select('name', 'id')->get();
        $brands = Brand::latest()->select('name', 'id')->get();
        $tags = Tag::latest()->select('name', 'id')->get();
        return view('dashboard.products.create')->with([
            'product' => new Product(),
            'categories' => $categories,
            'brands' => $brands,
            'tags' => $tags,
            'tagIDs' => [],
            'defualtCurrncy' => Currency::where('is_primary', 1)->first()
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|min:0|d',

        ]);
        $request->validate(Product::validateRules($request->price));
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        DB::beginTransaction();
        try {

            if ($request->hasFile('main_image') && $request->file('main_image')->isValid()) {
                $image = $request->file('main_image');
                $image = $image->store('/products/main', 'media');
                $request->merge(['image_path' => $image]);
            }
            $product = Product::create($request->all());
            if ($request->hasFile('gallery')) {
                $images = $request->file('gallery');
                foreach ($images as $image) {
                    if ($image->isValid()) {
                        $image_path = $image->store('/products', 'media');
                        ProductImage::create([
                            'product_id' => $product->id,
                            'path' => $image_path,
                        ]);
                    }
                }
            }

            $product->tags()->attach($request->tags);

            DB::commit();

            return redirect()->route('products.index')
                ->with('success', "Product ($product->name) created.");

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        $product->load(['tags:id', 'brand']);
        $tagIDs = array();
        foreach ($product->tags as $tag) {
            $tagIDs[] = $tag->id;
        }

        $categories = Category::withTrashed()->latest()->select('name', 'id')->get();
        $brands = Brand::latest()->select('name', 'id')->get();
        $tags = Tag::latest()->select('name', 'id')->get();
        return view('dashboard.products.edit')->with([
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'tags' => $tags,
            'tagIDs' => $tagIDs,
            'defualtCurrncy' => Currency::where('is_primary', 1)->first()
        ]);

    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        if ($product->images()->count() != 0) {
            $images = $product->images;
            foreach ($images as $image) {
                Storage::disk('media')->delete($image->path);
            }
        }
        Storage::disk('media')->delete('image_path');
        $product->tags()->detach();
        $product->delete();

        return redirect()->route('products.index')->with([
            'success' => "($product->name) Product Deleted Successfully"
        ]);

    }


    public function trash()
    {
        $products = Product::onlyTrashed()->paginate();
        return view('dashboard.products.trash')->with(['products' => $products]);
    }

    public function restore(Request $request, $id = null)
    {
        if ($id) {
            $product = Product::onlyTrashed()->findOrFail($id);
            $product->restore();

            return redirect()->route('products.index')->with([
                'success' => "Product ($product->name) Restored",
            ]);
        }
        Product::onlyTrashed()->restore();
        return redirect()->route('products.index')->with([
            'success' => "All Products Restored",
        ]);
    }

    public function forceDelete($id = null)
    {
        if ($id) {
            $product = Product::onlyTrashed()->findOrFail($id);
            $product->forceDelete();
            return redirect()->route('products.trash')->with([
                'success' => "Product ($product->name) Deleted For Ever"
            ]);
        }
        Product::onlyTrashed()->forceDelete();
        return redirect()->route('products.trash')->with([
            'success' => "All Products Deleted For Ever"
        ]);
    }
}

