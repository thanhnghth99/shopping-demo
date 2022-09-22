<?php

namespace App\View\Components\Pages;

use App\Models\Category as ModelsCategory;
use Illuminate\View\Component;

class Category extends Component
{
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = null)
    {
        $this->class = $class;
    }

    public function getCategory()
    {
        $categories = ModelsCategory::all()->sortBy('name');
        return $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pages.category');
    }
}
