<?php

namespace App\Http\Livewire\Website\Products;

use App\Traits\GetProductDetails;
use Illuminate\View\View;
use Livewire\Component;

class ProductPage extends Component
{
    use GetProductDetails;

    public function render(): View
    {
        return view('website.content.products.product-page');
    }
}