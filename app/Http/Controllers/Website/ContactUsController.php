<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        return view('website.content.contact-us');
    }
}
