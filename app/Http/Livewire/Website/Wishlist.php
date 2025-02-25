<?php

namespace App\Http\Livewire\Website;

use App\Http\Livewire\Website\Cart\CartMenu;
use App\Repositories\Cart\CartInterfaceRepo;
use Illuminate\View\View;
use Livewire\Component;

class Wishlist extends Component
{
    public $wishlist;

    public function mount(): void
    {
        $this->wishlist = \App\Models\wishlist::with('product')->get();
    }

    public function delete(\App\Models\wishlist $item): void
    {
        $item->delete();
        // Filter $this->wishlist and remove the deleted item
        $this->wishlist = $this->wishlist->filter(function($wishlistItem) use ($item) {
            return $wishlistItem->id !== $item->id;
        });
        $this->emit('notify-success', "Item Removed Wishlist Successfully!");
//        $this->mount();
    }

    public function render(): View
    {
        return view('website.content.pages.wishlist')
            ->layoutData(['title' => 'Wishlist']);
    }
}
