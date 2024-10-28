<?php

namespace App\View\Components\Datatable;

use Illuminate\View\Component;

class Filter extends Component
{
    public $target;

    public $collapsed;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($target, $collapsed = '')
    {
        $this->target = $target;
        $this->collapsed = $collapsed == true ? 'show' : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.datatable.filter');
    }
}
