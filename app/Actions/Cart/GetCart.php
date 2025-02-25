<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use Illuminate\Support\Collection;


class GetCart
{
    public static function execute(): array
    {
        $items = self::fetchCartItems();
        $total = self::calculateTotal($items);
        $cartCount = $items->count();

        return [
            'items' => $items,
            'total' => $total,
            'cart_count' => $cartCount,
        ];
    }

    private static function fetchCartItems(): Collection
    {
        return Cart::with('product')->get();
    }

    private static function calculateTotal(Collection $items): float
    {
        return $items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
}