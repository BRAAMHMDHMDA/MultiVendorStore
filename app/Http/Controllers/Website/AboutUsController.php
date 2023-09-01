<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{

    public function __invoke(Request $request)
    {
        return view('website.content.about-us');
    }
}
