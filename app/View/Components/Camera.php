<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Camera extends Component
{
    public $name;
    public $label;
    public $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $route)
    {
        $this->name = $name;
        $this->label = $label;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.camera');
    }
}
