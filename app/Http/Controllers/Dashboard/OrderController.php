<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Middleware\MarkNotificationAsRead;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(MarkNotificationAsRead::class)->only('show');
    }

    public function index()
    {
        $orders = Order::latest()->paginate();
        return view('dashboard.content.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Order $order)
    {
        $order->load('products');
        return view('dashboard.content.orders.show', [
            'order' => $order,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return redirect()->route('dashboard.orders.index')->with('success', 'Order Status Updated');
    }
}
