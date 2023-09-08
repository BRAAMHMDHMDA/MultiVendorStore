<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    public function index(){
        return view('website.content.wishlist');
    }
}
