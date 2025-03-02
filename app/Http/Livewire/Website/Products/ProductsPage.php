<?php

namespace App\Http\Livewire\Website\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsPage extends Component
{
    use WithPagination;

    public $categories, $tags;
    public $search, $min_price, $max_price, $category_selected = "", $tags_selected = [];
    protected $queryString = [
            'search' => ['except' => ''], 'min_price' => ['except' => ''],
            'max_price' => ['except' => ''], 'category_selected' => ['except' => ''],
            'tags_selected' => ['except' => '']
        ];

    public function mount(): void {
        $this->categories = Cache::rememberForever('categories_list', function () {
            return Category::get();
        });
        $this->tags = Cache::rememberForever('tags_list', function () {
            return Tag::get();
        });

    }

    public function updated(): void
    {
        $this->dispatchBrowserEvent('reinitializeModal');
    }
    private function getProducts(): LengthAwarePaginator|array
    {
        return Product::active()
            ->latest()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->min_price, fn($q) => $q->where('price', '>=', $this->min_price))
            ->when($this->max_price, fn($q) => $q->where('price', '<=', $this->max_price))
            ->when($this->category_selected, fn($q) => $q->whereHas('category', fn($query) =>
                $query->where('slug', 'like', '%' . $this->category_selected . '%')
            ))
            ->when(!empty($this->tags_selected), function ($q) {
                $q->whereHas('tags', fn($query) => $query->whereIn('slug', $this->tags_selected));
            })
            ->paginate(12);

    }

    public function clearFilter(): void
    {
        $this->reset(['search', 'min_price', 'max_price', 'category_selected']);
    }

    public function render(): View
    {
        return view('website.content.products.products-page', [
            'products' => $this->getProducts(),
        ])->layoutData(['title' => 'List Products']);
    }
}
