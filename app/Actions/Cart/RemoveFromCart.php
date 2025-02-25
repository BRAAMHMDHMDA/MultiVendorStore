<?php

namespace App\Actions\Cart;

use App\Models\Cart;

class RemoveFromCart
{
    public function __invoke(Cart $cart): void
    {
        $cart->delete();
    }
}