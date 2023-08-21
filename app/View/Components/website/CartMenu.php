<?php

namespace App\View\Components\Website;

use App\Facades\Cart;
use App\Repositories\Cart\CartInterfaceRepo;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartMenu extends Component
{
    public $items;
    public $total;

    public function __construct(CartInterfaceRepo $cart)
    {
        $this->items = $cart->get();
        $this->total = $cart->total();
    }

    public function render() : View
    {
        return view('components.website.cart-menu');
    }
}
