<?php

namespace App\Listeners;

use App\Facades\Cart;

class EmptyCart
{

    public function __construct()
    {
        //
    }

    public function handle($event): void
    {
        Cart::empty();
    }
}
