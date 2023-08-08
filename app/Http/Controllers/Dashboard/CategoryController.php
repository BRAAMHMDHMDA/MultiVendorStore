<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function dt()
    {
        $data = Category::with('parent')->withCount('products');
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',  function ($row) {
                return view('dashboard.content.categories.action_buttons', ['id' => $row->id])->render();
            })
            ->addColumn('parent', function ($row) {
                return $row->parent->name;
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->make(true);
    }


    public function index()
    {
//        return view('dashboard.content.categories.indexDT');
        //
      $categories = Category::with('parent')->withCount('products')->latest()->paginate();
      return view('dashboard.content.categories.index', [
        'categories' => $categories
      ]);
    }

    public function create()
    {
        //
      $parents = Category::all();
      $category = new Category();
      return view('dashboard.content.categories.create', compact('category', 'parents'));
    }


    public function store(CategoryRequest $request)
    {
      $data = $request->except('image');
      $data['image'] = Category::storeImage($request);

      Category::create($data);

      return Redirect::route('dashboard.categories.index')
        ->with('success', 'Category created Successfully!');
    }


    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        $parents = Category::where('id', '<>', $category->id)
            ->where(function($query) use ($category) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $category->id);
            })
            ->get();

        return view('dashboard.content.categories.edit', compact('category', 'parents'));

    }


    public function update(CategoryRequest $request, Category $category)
    {

        $old_image = $category->image;
        $data = $request->except('image');

//        if ($request->hasFile('image') && $request->file('image')->isValid()){
//            $image = $request->file('image');
//            $image = $image->store('/categories', 'media');
//            $data['image'] = $image;
//        }
        $data['image'] = Category::updateImage($request, $old_image);
        $category->update($data);

//        if ($old_image && isset($data['image'])) {
//            Storage::disk('media')->delete($old_image);
//        }
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category updated!');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        Category::deleteImage($category->image);

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Deleted Successfully!');
    }
}
