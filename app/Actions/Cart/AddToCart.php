<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Models\Product;

class AddToCart
{
    public static function execute(Product $product, $quantity=1): void
    {
        $item =  Cart::where('product_id', '=', $product->id)->first();

        if (!$item) {
            Cart::create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }else{
            $item->increment('quantity', $quantity);
        }

    }
}