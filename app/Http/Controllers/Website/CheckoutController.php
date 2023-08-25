<?php

namespace App\Http\Controllers\Website;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartInterfaceRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{

    function create (CartInterfaceRepo $cart)
    {
        return view('website.content.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    }

    function store (Request $request, CartInterfaceRepo $cart)
    {
//        $request->dd();
        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {

                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'COD',
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }
                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    if (!($address['type']==='shipping' && $address['first_name']===null)){
                        $order->addresses()->create($address);
                    }
                }
            }

            DB::commit();
            event(new OrderCreated($order));

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('home');
    }
}
