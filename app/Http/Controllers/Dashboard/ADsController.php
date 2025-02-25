<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ADsRequest;
use App\Models\AD;
use Illuminate\Support\Facades\Redirect;

class ADsController extends Controller
{

    public function index()
    {
        return view('dashboard.content.ADs.index',[
            'ADs' => AD::latest()->paginate(10),
        ]);
    }


    public function create()
    {
        $AD = new AD();
        return view('dashboard.content.ADs.create', compact('AD'));
    }

    public function store(ADsRequest $request)
    {
        AD::storeImage($request);
        AD::create($request->all());

        return Redirect::route('dashboard.ADs.index')
            ->with('success', 'AD created Successfully!');
    }


    public function edit(AD $AD)
    {
        return view('dashboard.content.ADs.edit', compact('AD'));
    }


    public function update(ADsRequest $request, AD $AD)
    {
        AD::updateImage($request, $AD->image_path);
        $AD->update($request->all());

        return Redirect::route('dashboard.ADs.index')
            ->with('success', 'AD updated!');
    }


    public function destroy(AD $AD)
    {
        $AD->delete();
        AD::deleteImage($AD->image_path);

        return Redirect::route('dashboard.ADs.index')
            ->with('success', 'AD Deleted Successfully!');
    }
}
