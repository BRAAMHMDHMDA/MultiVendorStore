<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function dt(CategoryDataTable $dataTable)
    {
//        return $dataTable->render('dashboard.content.categories.indexDT');
        $data = Category::with('parent')->withCount('products')->latest();
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return $btn = '
                    <a href="' . Route('dashboard.categories.edit', $row->id) . '"  class="edit btn btn-outline btn-sm" ><i class="fa fa-edit "></i></a>
                    <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-outline btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash-can text-danger" ></i></a>';
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
        return view('dashboard.content.categories.indexDT');
        //
//      $categories = Category::with('parent')->withCount('products')->latest()->paginate();
//      return view('dashboard.content.categories.index', [
//        'categories' => $categories
//      ]);
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
//      // Request merge
//      $request->merge([
//        'slug' => \Str::slug($request->post('name'))
//      ]);

      $data = $request->except('image');

      //      $data['image'] = $this->uploadImgae($request);
        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $image = $request->file('image');
            $image = $image->store('/categories', 'media');
            $data['image'] = $image;
        }
      // Mass assignment
      $category = Category::create( $data );

      // PRG
      return Redirect::route('dashboard.categories.index')
        ->with('success', 'Category created Successfully!');
    }


    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //try {
        //            $categories = Category::findOrFail($id);
        //        } catch (Exception $e) {
        //            return redirect()->route('dashboard.categories.index')
        //                ->with('info', 'Record not found!');
        //        }
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
        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $image = $request->file('image');
            $image = $image->store('/categories', 'media');
            $data['image'] = $image;
        }

        $category->update( $data );

        if ($old_image && isset($data['image'])) {
            Storage::disk('media')->delete($old_image);
        }
        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category updated!');
    }


    public function destroy(Category $category)
    {
        //
        $category->delete();

//        if ($categories->image) {
//            Storage::disk('public')->delete($categories->image);
//        }

        //Category::where('id', '=', $id)->delete();
        //Category::destroy($id);
        if ($category->image) {
            Storage::disk('media')->delete($category->image);
        }

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category Deleted Successfully!');
    }
}
