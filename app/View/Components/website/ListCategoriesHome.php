<?php

namespace App\View\Components\website;

use App\Models\Category;
use Illuminate\View\Component;

class ListCategoriesHome extends Component
{
    public $categories;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = Category::whereNull('parent_id')->with('children')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.website.list-categories-home');
    }
}
