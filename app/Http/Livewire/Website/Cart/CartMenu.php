<?php

namespace App\Http\Livewire\Website\Cart;

use App\Repositories\Cart\CartInterfaceRepo;
use Illuminate\View\View;
use Livewire\Component;

class CartMenu extends Component
{
    public $items;
    public $total;
    protected CartInterfaceRepo $cart;

    protected $listeners = [
        'updateCart' => 'loadCart',
        'addToCart' => 'addToCart',
    ];

    public function boot(CartInterfaceRepo $cart): void
    {
        $this->cart = $cart;
    }

    public function mount(): void
    {
        $this->loadCart();
    }
    public function loadCart(): void
    {
        $this->items = $this->cart->get();
        $this->total = $this->cart->total();
    }

    public function addToCart($productId): void
    {
        $this->items = $this->cart->add($productId, 1); // Adding 1 quantity
        $this->emit('notify-success', "Successfully Added to your Cart!");
        $this->dispatchBrowserEvent('added-cart');
    }

    public function removeItem($id, CartInterfaceRepo $cart): void
    {
        $cart->delete($id);
        $this->loadCart();
        $this->emit('notify-success', "Item Deleted Successfully!");
    }

    public function render(): View
    {
        return view('website.content.cart.cart-menu');
    }
}
