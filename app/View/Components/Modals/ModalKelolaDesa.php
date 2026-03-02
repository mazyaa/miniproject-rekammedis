<?php

namespace App\View\Components\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalKelolaDesa extends Component
{
    public $iconHome = '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>';
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $type = 'default',
        public $judul,
        public $d = []
    ) {
        $this->type = $type;
        $this->judul = $judul;
        $this->d = $d;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.modal-kelola-desa');
    }
}
