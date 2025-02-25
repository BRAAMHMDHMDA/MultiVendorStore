<?php

namespace App\Traits;


use App\Models\Product;
use App\Models\wishlist;

trait GetProductDetails
{
    public Product $product;
    public bool $isFav = false;
    public string $class;

    public function mount(Product $product): void
    {
        $this->product = $product;
        $this->isFav = $this->product->isFav;
    }

    //toggleFav
    public function toggleFav(): void
    {
        $this->isFav = !$this->isFav;
        if ($this->isFav) {
            wishlist::create([
                'product_id' => $this->product->id,
                'cookie_id' => wishlist::getCookieId(),
            ]);
            $this->emit('notify-success', "Product Added To Wishlist!");
        }
        else{
            wishlist::where('product_id', $this->product->id)
                ->where('cookie_id', wishlist::getCookieId())
                ->delete();
            $this->emit('notify-success', "Product Removed From Wishlist!");
        }
        $this->dispatchBrowserEvent('reinitializeModal');
    }

}