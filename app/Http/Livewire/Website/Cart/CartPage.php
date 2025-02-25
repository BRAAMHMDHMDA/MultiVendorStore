<?php

namespace App\Http\Livewire\Website\Cart;

use App\Repositories\Cart\CartInterfaceRepo;
use Illuminate\View\View;
use Livewire\Component;

class CartPage extends Component
{
    public $items;
    public $total;
    protected CartInterfaceRepo $cart;
    public $quantities = [];


    public function boot(CartInterfaceRepo $cart): void { $this->cart = $cart; }

    public function mount(): void
    {
        $this->loadCart();
    }

    public function loadCart(): void
    {
        $this->items = $this->cart->get();
        $this->total = $this->cart->total();

        // Populate quantity array
//        foreach ($this->items as $item) {
//            $this->quantities[$item->product->id] = $item->quantity;
//        }
        // Store initial quantities for each item
        $this->quantities = $this->items->pluck('quantity', 'id')->toArray();
    }
    public function updatedQuantities($value, $key): void
    {
        // Validate quantity to ensure it's positive
        $quantity = max(1, intval($value));

        // Update the cart
        $this->cart->update($key, $quantity);
        $this->refreshCart();
        $this->emit('notify-success', 'Quantity updated successfully!');
    }


    public function removeItem($id): void
    {
        $this->cart->delete($id);
        $this->refreshCart();
        $this->emit('notify-success', "Item Deleted Successfully!");
    }

    private function refreshCart(): void
    {
        $this->loadCart();
        $this->emit('updateCart'); // Emit an event if needed for other components
    }

    public function render(): View
    {
        return view('website.content.cart.cart-page')
            ->layoutData(['title' => 'Cart Page']);
    }
}
