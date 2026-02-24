<?php

namespace App\View\Components\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalKelolaDesa extends Component
{
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
