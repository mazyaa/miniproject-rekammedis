{{--
    Reusable Empty State Modal Component

    Usage:
    <x-modals.empty-state-modal
        :show="$data->isEmpty()"
        modalId="emptyStateModal"
        icon="bi-person-badge"
        title="Belum Ada Data Jenis Kelamin"
        message="Data jenis kelamin masih kosong. Mulai tambahkan data jenis kelamin pertama untuk memulai pengelolaan data pasien."
        addButtonText="Tambah Jenis Kelamin Pertama"
        addButtonTarget="#tambah"
        tip="Anda dapat menambahkan jenis kelamin baru dengan mengklik tombol Tambah di bagian atas halaman."
    />
--}}

@if ($show)
    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 bg-light">
                    <h5 class="modal-title fw-bold" id="{{ $modalId }}Label">
                        <i class="bi {{ $icon }} text-info me-2"></i>{{ $title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-5">
                    <div class="mb-4">
                        <i class="bi {{ $icon }}" style="font-size: 4rem; color: #6c757d;"></i>
                    </div>
                    <h5 class="mb-3 text-dark fw-bold">{{ $title }}</h5>
                    <p class="text-muted mb-4">
                        {{ $message }}
                    </p>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-lightbulb me-2"></i>
                        <strong>Tip:</strong> {{ $tip }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="{{ $addButtonTarget }}" data-bs-dismiss="modal">
                        <i class="bi bi-plus"></i> {{ $addButtonText }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
