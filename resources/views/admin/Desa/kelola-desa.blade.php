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
                        <li class="breadcrumb-item active @if (request()->path() == 'kelola-desa') text-primary @endif"
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
                        <x-modals.empty-state-modal :show="$data->isEmpty()" modalId="emptyStateModal" icon="bi-map" title="Belum Ada Data Desa"
                            message="Data desa masih kosong. Mulai tambahkan data desa pertama untuk memulai pengelolaan data pasien."
                            addButtonText="Tambah Desa Pertama" addButtonTarget="#tambah"
                            tip="Anda dapat menambahkan desa baru dengan mengklik tombol Tambah di bagian atas halaman." />

                        
                        {{-- EMPTY STATE --}}
                        @if ($data->isEmpty())
                            <x-empty-state icon="bi-house-heart-fill" titleEmpty="Belum Ada Data Desa"
                                message="Data desa masih kosong. Mulai tambahkan data desa pertama untuk memulai pengelolaan data pasien."
                                actionText="Tambah Desa Pertama" actionTarget="#tambah" />
                        @endif

                        <!-- Card Layout - Modern & Responsive -->
                        <div class="row mb-5">
                            @foreach ($data as $d)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card border-0 shadow-sm h-100 btn-primary" style="transition: all 0.3s ease; cursor: pointer;"
                                        onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 12px 24px rgba(16, 185, 129, 0.3)';"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,.05)'">

                                        <div class="card-body d-flex flex-column justify-content-between align-items-center text-white"
                                            style="padding: 40px 30px;">
                                            <!-- Village Icon -->
                                            <div class="mb-4 text-center">
                                                <i class="bi bi-houses" style="font-size: 4rem; color: rgba(255,255,255,0.9);"></i>
                                            </div>

                                            <!-- Village Name -->
                                            <div class="text-center mb-4">
                                                <h5 class="fw-bold mb-0" style="font-size: 20px;">{{ $d->nama_desa }}</h5>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="d-flex gap-2 w-100">
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-sm flex-grow-1 btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#edit-{{ $d->id }}"
                                                    onmouseover="this.style.background='linear-gradient(135deg, rgba(6, 182, 212, 0.5), rgba(8, 145, 178, 0.5))'; this.style.boxShadow='0 6px 16px rgba(6, 182, 212, 0.3)'; this.style.transform='translateY(-2px)';"
                                                    onmouseout="this.style.background='linear-gradient(135deg, rgba(6, 182, 212, 0.3) 0%, rgba(8, 145, 178, 0.3) 100%)'; this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </button>

                                                <!-- Delete Button -->
                                                <form action="{{ url('kelola-desa-hapus-' . $d->id) }}" method="POST" id="delete-form-{{ $d->id }}" style="flex: 1;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-id="{{ $d->id }}" data-nama="{{ $d->nama_desa }}" data-entity="Desa" class="btn btn-sm w-100"
                                                        style="background: rgba(220, 38, 38, 0.8); border: 1px solid rgba(220, 38, 38, 0.6); color: white; padding: 10px; border-radius: 8px; font-weight: 600; transition: all 0.3s ease;"
                                                        onmouseover="this.style.background='rgba(220, 38, 38, 0.95)'; this.style.boxShadow='0 6px 16px rgba(220, 38, 38, 0.3)'; this.style.transform='translateY(-2px)';"
                                                        onmouseout="this.style.background='rgba(220, 38, 38, 0.8)'; this.style.boxShadow='none'; this.style.transform='translateY(0)'">
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
            <x-modals.modal-kelola-desa judul="Tambah Data Desa" type="tambah" />
            @foreach ($data as $d)
                <x-modals.modal-kelola-desa judul="Edit Data Desa" type="edit" :d="$d" />
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
