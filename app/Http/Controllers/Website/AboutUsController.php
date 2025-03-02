<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{

    public function __invoke(Request $request)
    {
        $testimonials = Testimonial::active()->inRandomOrder()->take(3)->get();
        $brands = Brand::select(['id','image_path'])->inRandomOrder()->take(8)->get();
        return view('website.content.about-us', compact(['testimonials', 'brands']));
    }
}
