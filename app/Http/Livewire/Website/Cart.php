<?php

namespace App\Http\Livewire\Website;

use App\Actions\Cart\AddToCart;
use App\Actions\Cart\GetCart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Cart extends Component
{
    public Collection $items;
    public $total;
    public $cart_count;

    public function mount(): void
    {
        $this->getCart();
    }

    private function getCart(): void
    {
        $cart = GetCart::execute();
        $this->items = $cart['items'];
        $this->total = $cart['total'];
        $this->cart_count = $cart['cart_count'];
    }

    protected $listeners = ['addToCart' => 'add'];
    public function add(Product $product): void
    {
        AddToCart::execute($product);
        $this->getCart();
        $this->emit('notify_success', "$product->name Added To Cart");

    }

    public function update($id, $quantity): void
    {
        \App\Models\Cart::where('id', '=', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id): void
    {
        \App\Models\Cart::where('id', '=', $id)->delete();
        $this->getCart();
        $this->emit('notify_success', "Item Deleted Successfully");
    }

    public function empty(): void
    {
        Cart::query()->delete();
    }

    private function total() : float
    {
        return $this->items->sum(function($item) {
            return $item->quantity * $item->product->price;
        });
    }

    public function render(): View
    {
        return view('website.content.sections.cart');
    }
}
