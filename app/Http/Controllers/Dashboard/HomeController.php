<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        $count_products = Product::active()->count();
        $count_orders_completed = Order::where('status','completed')->count();
        $count_orders = Order::where('status',"!=",'completed')->count();
        $count_customers = User::count();

        $featured_products = Product::where('featured',1)->latest()->take(6)->get();
        $top_stores = Store::withCount('orders')
                        ->whereHas('orders')
                        ->orderByDesc('orders_count')
                        ->take(8)
                        ->get();
        $special_customers = User::withCount('orders')
                        ->whereHas('orders')
                        ->orderByDesc('orders_count')
                        ->take(8)
                        ->get();

        return view('dashboard.content.pages.pages-home', get_defined_vars());
    }
}
