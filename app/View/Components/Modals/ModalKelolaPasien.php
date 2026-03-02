<?php

namespace App\View\Components\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalKelolaPasien extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $judul,
        public $type = 'default',
        public $jeniskelamin,
        public $desa,
        public $d = null,
        public $pasien = null
    ) {
        $this->judul = $judul;
        $this->type = $type;
        $this->d = $d;
        $this->jeniskelamin = $jeniskelamin;
        $this->desa = $desa;
        $this->pasien = $pasien;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.modal-kelola-pasien');
    }
}
