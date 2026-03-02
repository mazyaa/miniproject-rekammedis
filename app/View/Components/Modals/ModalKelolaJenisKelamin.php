<?php

namespace App\View\Components\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalKelolaJenisKelamin extends Component
{
     public $iconUsers = '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>';
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $type ='default',
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
        return view('components.modals.modal-kelola-jenis-kelamin');
    }
}
