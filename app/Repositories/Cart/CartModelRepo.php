<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepo implements CartInterfaceRepo
{
    protected Collection $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get() : Collection
    {
        if (!$this->items->count()) {
//            $this->items = Cart::with('product')->get();
            $this->items = Cart::with(['product' => function ($query) {
                $query->without('category', 'brand', 'store'); // Exclude unwanted relations
            }])->get();
        }

        return $this->items;
    }

    public function add($product_id, $quantity=1): Collection
    {
        $item =  Cart::where('product_id', '=', $product_id)->first();

        if (!$item) {
            $cart = Cart::create([
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
            return $this->get();
        }

        $item->increment('quantity', $quantity);
        return $this->get();
    }

    public function update($id, $quantity): void
    {
        Cart::where('id', '=', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id): void
    {
        Cart::where('id', '=', $id)->delete();
    }

    public function empty(): void
    {
        Cart::query()->delete();
    }

    public function total() : float
    {
        /*return (float) Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');*/

        return $this->get()->sum(function($item) {
            return $item->quantity * $item->product->price;
        });
    }
}