<x-app-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-primary fw-bold">{{ $title }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/dashboard" class="text-black-50">Home</a></li>
                        <li class="breadcrumb-item active @if (request()->path() == 'kelola-jenis-kelamin') text-primary @endif"
                            aria-current="page">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <!-- Tombol Tambah -->
            <div class="row mb-4">
                <div class="col-12">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                        <i class="bi bi-plus"></i> Tambah
                    </button>
                </div>
            </div>
{{-- REUSABLE EMPTY STATE MODAL --}}
<x-modals.empty-state-modal :show="$data->isEmpty()" modalId="emptyStateModal" icon="bi-person-badge"
    title="Belum Ada Data Jenis Kelamin"
    message="Data jenis kelamin masih kosong. Mulai tambahkan data jenis kelamin pertama untuk memulai pengelolaan data pasien."
    addButtonText="Tambah Jenis Kelamin Pertama" addButtonTarget="#tambah"
    tip="Anda dapat menambahkan jenis kelamin baru dengan mengklik tombol Tambah di bagian atas halaman." />

{{-- EMPTY STATE --}}
@if ($data->isEmpty())
    <x-empty-state icon="bi-gender-neuter" titleEmpty="Belum Ada Data Jenis Kelamin"
        message="Data jenis kelamin masih kosong. Mulai tambahkan data jenis kelamin pertama untuk memulai pengelolaan data pasien."
        actionText="Tambah Jenis Kelamin Pertama" actionTarget="#tambah" />
@endif

            <!-- Stats Cards Layout - Colorful & Modern -->
            <div class="row mb-5">
                @foreach ($data as $d)
                    <div class="col-md-6 mb-4">
                        <div class="card stats-card border-0 shadow-sm h-100"
                            style="background: {{ $d->bgGradient }}; transition: all 0.3s ease; cursor: pointer;"
                            onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(2,132,199,0.2)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,.05)'">

                            <div class="card-body d-flex flex-column justify-content-between" style="padding: 35px;">
                                <!-- Top Section: Icon & Title -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <div class="stat-icon" style="font-size: 3rem; color: {{ $d->iconColor }};">
                                            <i class="bi {{ $d->icon }}"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 fw-bold" style="color: {{ $d->textColor }}; font-size: 18px;">
                                                {{ $d->deskripsi }}</h5>
                                            <small class="text-muted d-block"
                                                style="font-size: 12px;">{{ $d->subText }}</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Count Display -->
                                <div class="mb-5">
                                    <h2 class="fw-bold mb-0" style="color: {{ $d->textColor }}; font-size: 2.5rem;">
                                        {{ number_format($d->count) }}</h2>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-2">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-sm flex-grow-1"
                                        style="background: linear-gradient(135deg, #06b6d4, #0891b2); border: none; color: white; padding: 10px; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;"
                                        data-bs-toggle="modal" data-bs-target="#edit-{{ $d->id }}"
                                        onmouseover="this.style.boxShadow='0 6px 16px rgba(6, 182, 212, 0.3)'; this.style.transform='translateY(-2px)';"
                                        onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ url('kelola-jenis-kelamin-hapus-' . $d->id) }}"
                                        method="POST" id="delete-form-{{ $d->id }}" style="flex: 1;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-id="{{ $d->id }}"
                                            data-nama="{{ $d->deskripsi }}" data-entity="Jenis Kelamin"
                                            class="btn btn-sm btn-danger w-100"
                                            style="padding: 10px; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;"
                                            onmouseover="this.style.boxShadow='0 6px 16px rgba(239, 68, 68, 0.3)'; this.style.transform='translateY(-2px)';"
                                            onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Modals -->
            <x-modals.modal-kelola-jenis-kelamin judul="Tambah Data Jenis Kelamin" type="tambah" />
            @foreach ($data as $d)
                <x-modals.modal-kelola-jenis-kelamin judul="Edit Data Jenis Kelamin" type="edit" :d="$d" />
            @endforeach
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        { { -- ! AUTO SHOW EMPTY STATE MODAL-- } }
        @if ($data->isEmpty())
            const emptyStateModal = new bootstrap.Modal(document.getElementById('emptyStateModal'));
            emptyStateModal.show();
        @endif

        // ! Konfirmasi Delete
        document.querySelectorAll('form[id^="delete-form-"]').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const namaData = form.querySelector('button').getAttribute('data-nama');
                const entity = form.querySelector('button').getAttribute('data-entity');

                Swal.fire({
                    title: 'Konfirmasi Penghapusan',
                    text: `Apakah Anda yakin ingin menghapus ${entity} dengan nama "${namaData}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // ! Flash Message Success
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK',
                confirmButtonColor: '#28a745'
            });
        @endif

        // ! Flash Message Error
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545'
            });
        @endif
    });
</script>
