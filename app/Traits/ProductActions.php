<?php

namespace App\Traits;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartInterfaceRepo;
use Illuminate\Support\Facades\Request;

trait ProductActions
{
  protected CartInterfaceRepo $cart;

  public function mount(CartInterfaceRepo $cart): void
  {
    $this->cart = $cart;
  }
  public function addToCart($product, $quantity = 1): void
  {
//    // TODO: Add to cart
//    $product = Product::where('id', $product_id)->first();
//    $cart = Cart::where('product_id', $product_id)->first('quantity');
//    $QTYInCart = $cart !== null ? $cart->quantity : 0;
//
//    Request::validate([
//      'product_id' => ['required', 'int', 'exists:products,id'],
//      'quantity' => ['nullable', 'int', 'min:1', function ($attribute, $value, $fail) use ($product, $QTYInCart) {
//        if ($product && ($product->quantity==0 || $QTYInCart >= $product->quantity )) {
//          $fail("The selected quantity exceeds the available stock.");
//        }
//      }],
//    ]);

    $this->cart->add($product);



  }

  public function toggleWishlist($id): void
  {
    // TODO: Toggle wishlist
  }

}
