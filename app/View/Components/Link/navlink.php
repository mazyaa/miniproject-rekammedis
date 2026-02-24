<?php

namespace App\View\Components\Link;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navlink extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $route,
        public $icon = null,
        public $menu = null,
        public $dropdown = null
    ) {
        $this->route = $route;
        $this->icon = $icon;
        $this->menu = $menu;
        $this->dropdown = $dropdown;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.link.navlink');
    }
}
