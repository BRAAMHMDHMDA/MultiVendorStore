<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(){
        $wishlist = wishlist::with('product')->get();
        return view('website.content.wishlist',[
            'wishlist' => $wishlist
        ]);
    }

    public function store(Request $request)
    {
        $isAdded =  wishlist::where('product_id',$request->product_id)->first();
        if ($isAdded){
            return response()->json([
                'message' => "Product in Wishlist!",
            ], 409 );
        }
        wishlist::create([
            'product_id' => $request->product_id,
        ]);

        return response()->json([
            'message' => "Product added to wishlist!",
        ], 201);

    }
    public function destroy(wishlist $wishlist)
    {
        $wishlist->delete();

        return response()->json([
            'message' => "Product deleted to wishlist!",
        ], 201);

    }
}
