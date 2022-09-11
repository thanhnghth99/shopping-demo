<?php

namespace App\View\Components\Pages;

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
