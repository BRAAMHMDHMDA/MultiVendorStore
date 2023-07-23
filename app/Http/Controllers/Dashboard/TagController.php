<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index()
    {
        return view('dashboard.content.tags.index')->with([
            'tags' => Tag::latest()->paginate(10),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:tags|min:2|max:20']);

        Tag::create($request->all());

        return redirect()->route('dashboard.tags.index')->with([
            'success' => "($request->name) Tag Created Successfully"
        ]);
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate(['name' => 'required',Rule::unique('tags','name')->ignore($tag->id)]);
        $tag->update($request->all());

        return redirect()->route('dashboard.tags.index')->with([
            'success' => "($request->name) Tag Updated Successfully"
        ]);
    }

    public function destroy(tag $tag)
    {
        if ($tag->products()->count())
        {
            return redirect()->route('dashboard.tags.index')->with([
                'warning' => "($tag->name) Tag Linked with Products, First Must Delete Linked Products"
            ]);
        }
        $tag->delete();

        return redirect()->route('dashboard.tags.index')->with([
            'success' => "($tag->name) Tag Deleted Sucessfully"
        ]);
    }
}