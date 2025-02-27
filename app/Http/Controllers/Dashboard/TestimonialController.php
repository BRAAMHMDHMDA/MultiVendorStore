<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TestimonialController extends Controller
{

    public function index()
    {
        return view('dashboard.content.testimonials.index',[
            'testimonials' => Testimonial::latest()->paginate(10),
        ]);
    }


    public function create()
    {
        $testimonial = new Testimonial();
        return view('dashboard.content.testimonials.create', compact('testimonial'));
    }


    public function store(Request $request)
    {
        Testimonial::storeImage($request);
        Testimonial::create($request->all());

        return Redirect::route('dashboard.testimonials.index')
            ->with('success', 'Testimonial created Successfully!');
    }


    public function edit(Testimonial $testimonial)
    {
        return view('dashboard.content.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        Testimonial::updateImage($request, $testimonial->image_path);
        $testimonial->update($request->all());

        return Redirect::route('dashboard.testimonials.index')
            ->with('success', 'Testimonial Updated!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        Testimonial::deleteImage($testimonial->image_path);

        return Redirect::route('dashboard.testimonials.index')
            ->with('success', 'Testimonial Deleted Successfully!');
    }
}
