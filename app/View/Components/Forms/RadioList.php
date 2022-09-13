<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class RadioList extends Component
{
    public $name;
    public $id;
    public $items;
    public $selected;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name, 
        $id = null, 
        $items = [],
        $selected  = null,
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->items = $items;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.radio-list');
    }
}
