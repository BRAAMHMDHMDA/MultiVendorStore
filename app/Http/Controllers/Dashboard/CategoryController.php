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
    public function __construct()
    {
        $this->middleware('admin')->except('index');
    }

//    public function dt()
//    {
//        $data = Category::with('parent')->withCount('products');
//        return  Datatables::of($data)
//            ->addIndexColumn()
//            ->addColumn('action',  function ($row) {
//                return view('dashboard.content.categories.action_buttons', ['id' => $row->id])->render();
//            })
//            ->addColumn('parent', function ($row) {
//                return $row->parent->name;
//            })
//            ->addColumn('created_at', function ($row) {
//                return $row->created_at->diffForHumans();
//            })
//            ->make(true);
//    }


    public function index()
    {
//        return view('dashboard.content.categories.indexDT');
        //
      $categories = Category::with('parent')->withCount('products')->latest()->paginate(10);
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
      Category::storeImage($request);
      Category::create($request->all());

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
        Category::updateImage($request, $category->image_path);
        $category->update($request->all());

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category updated!');
    }


    public function destroy(Category $category)
    {
        if ($category->products()->count())
        {
            return redirect()->route('dashboard.categories.index')->with([
                'warning' => "($category->name) brand Linked with Products, First Must Delete Linked Products"
            ]);
        }
        $category->delete();
        Category::deleteImage($category->image_path);

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Deleted Successfully!');
    }
}
