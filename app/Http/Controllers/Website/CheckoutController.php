<?php

namespace App\Http\Controllers\Website;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Vendor;
use App\Notifications\OrderCreatedNotification;
use App\Repositories\Cart\CartInterfaceRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
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
            $request->validate([
                'addr.billing.*' => 'required',
                'addr.shipping.*' => [
                    function ($attribute, $value, $fail) use ($request) {
                        // Check if any input in addr.shipping.* is filled
                        $shippingFields = collect($request->input('addr.shipping', []));

                        if ($shippingFields->filter()->isNotEmpty() && empty($value)) {
                            $fail('Please fill out all shipping address inputs.');
                        }
                    }
                ],            ],[
                'addr.billing.*' => 'Please Fill out all Inputs',
            ]);

            foreach ($items as $store_id => $cart_items) {
                $total = $cart_items->sum(function($item) {
                    return $item->quantity * $item->product->price;
                });
                $order = Order::create([
                    'store_id' => $store_id,
                    'payment_method' => 'COD',
                    'total' => $total,
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
                //Begin::Send Notification To Admins && Vendors who have This Order
                $vendors = Vendor::where('store_id', $order->store_id)->get();
//                Notification::send(Admin::all(), new OrderCreatedNotification($order));
//                Notification::send($vendors, new OrderCreatedNotification($order));
                //End::Send Notification To Admins && Vendors who have This Order
            }

            DB::commit();
            event(new OrderCreated($order));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        if ($request->post('payment') === 'stripe'){
            return redirect()->route('orders.payments.create', $order->id);
        }else{
            return redirect()->route('account');
        }
    }
}
