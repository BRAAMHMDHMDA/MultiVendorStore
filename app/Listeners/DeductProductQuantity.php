<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DeductProductQuantity
{

    public function __construct()
    {
        //
    }

    public function handle(OrderCreated $event): void
    {
        $order = $event->order;



        foreach ($order->products as $product){


//            $cart = \App\Models\Cart::where('product_id', $product->id)->first('quantity');
//            $QTYInCart = $cart !== null ? $cart->quantity : 0;
//
//            if ($product && ($product->quantity == 0 || $QTYInCart >= $product->quantity)) {
//                throw new \Exception("The selected quantity exceeds the available stock.");
//            }
            // Fetch the quantity of the product in the cart
            $cartQuantity = \App\Models\Cart::where('product_id', $product->id)->value('quantity') ?? 0;

            // Check if the product is available and if the cart quantity exceeds the available stock
            if ($product && ($product->quantity == 0 || $cartQuantity >= $product->quantity)) {
                throw new \Exception("The selected quantity exceeds the available stock.");
            }

            $product->decrement('quantity', $product->order_item->quantity);
        }
//        foreach (Cart::get() as $item){
//            Product::where('id', $item->product_id)
//                ->update([
//                   'quantity' => DB::raw('quantity - '. $item->quantity)
//                ]);
//        }
    }
}
