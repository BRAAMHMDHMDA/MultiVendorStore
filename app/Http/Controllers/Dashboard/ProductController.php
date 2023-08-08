<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function index()
    {
        return view('dashboard.content.products.index');
    }

    public function datatable() {
        $query = Product::with('category:id,name');
        return Product::get_datatable($query);
    }

    public function create()
    {
        $categories = Category::latest()->select('name', 'id')->get();
        $brands = Brand::latest()->select('name', 'id')->get();
        $tags = Tag::latest()->select('name', 'id')->get();
        $category = new Category();
        return view('dashboard.content.products.create')->with([
            'product' => new Product(),
            'categories' => $categories,
            'brands' => $brands,
            'tags' => $tags,
            'category' => $category,
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function store(ProductRequest $request)
    {
        $data = $request->except('image');

        DB::beginTransaction();
        try {
            $data['image'] = Product::storeImage($request);
            $product = Product::create($data);
            $product->tags()->attach($request->tags);

            DB::commit();

            return redirect()->route('dashboard.products.index')
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
        $product->load(['tags:id', 'brand', 'category']);
        $tagIDs = array();
        foreach ($product->tags as $tag) {
            $tagIDs[] = $tag->id;
        }

        $categories = Category::latest()->select('name', 'id')->get();
        $brands = Brand::latest()->select('name', 'id')->get();
        $tags = Tag::latest()->select('name', 'id')->get();
        return view('dashboard.content.products.edit')->with([
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'tags' => $tags,
            'tagIDs' => $tagIDs,
        ]);

    }


    public function update(Request $request, Product $product)
    {
        $old_image = $product->image;
        $data = $request->except('image');
        if (!isset($data['featured'])) $data['featured'] = 0;

        DB::beginTransaction();
        try {
            $data['image'] = Category::updateImage($request, $old_image);
            $product->update($data);
            $product->tags()->sync($request->tags);

            DB::commit();

            return Redirect::route('dashboard.products.index')
                ->with('success', "Product ($product->name) Updated.");

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard.products.index')->with([
            'success' => "( $product->name ) Product Deleted Successfully"
        ]);

    }

    public function trash()
    {
        return view('dashboard.content.products.trash');
    }

    public function datatableTrashed() {
        $query = Product::onlyTrashed()->with('category:id,name');

        return Product::get_datatable($query, true);
    }

    public function restore(Request $request, $id = null)
    {
        if ($id) {
            $product = Product::onlyTrashed()->findOrFail($id);
            $product->restore();

            return redirect()->route('dashboard.products.index')->with([
                'success' => "Product ($product->name) Restored",
            ]);
        }
        Product::onlyTrashed()->restore();
        return redirect()->route('dashboard.products.index')->with([
            'success' => "All Products Restored",
        ]);
    }

    public function forceDelete($id = null)
    {
        if ($id) {
            $product = Product::onlyTrashed()->findOrFail($id);
            Product::deleteImage($product->image);
            $product->forceDelete();
            return redirect()->route('dashboard.products.trash')->with([
                'success' => "Product ($product->name) Deleted For Ever"
            ]);
        }

        $productsTrashed = Product::onlyTrashed();
        foreach ($productsTrashed as $productTrashed){
            Product::deleteImage($productTrashed->image);
        }
        $productsTrashed->forceDelete();
        return redirect()->route('dashboard.products.trash')->with([
            'success' => "All Products Deleted For Ever"
        ]);
    }
}

