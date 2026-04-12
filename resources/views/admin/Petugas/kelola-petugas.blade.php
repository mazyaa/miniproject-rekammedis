<x-app-layout>

    {{-- HEADER --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-primary fw-bold">Kelola Petugas</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Petugas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="app-content">
        <div class="container-fluid">

            {{-- TOOLBAR --}}
            <div class="d-flex flex-wrap gap-2 mb-4">
                <input type="text" id="searchPetugas" class="form-control w-auto"
                    placeholder="Cari username / email...">

                <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#tambahPetugas">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>

            {{-- MODAL TAMBAH --}}
            <x-modals.modal-kelola-petugas
                judul="Tambah Data Petugas"
                type="tambahPetugas" />

            {{-- EMPTY STATE --}}
            @if ($data->isEmpty())
                <x-empty-state
                    icon="bi-person-badge"
                    titleEmpty="Belum Ada Data Petugas"
                    message="Data petugas masih kosong. Mulai tambahkan data petugas<br>pertama untuk memulai pengelolaan sistem."
                    actionText="Tambah Petugas Pertama"
                    actionTarget="#tambahPetugas" />
            @endif

            {{-- CARD CONTAINER --}}
            <div id="petugasCards" class="row g-4"></div>

            {{-- NO SEARCH RESULT STATE (shown by JS) --}}
            <x-empty-state
                id="noResultState"
                icon="bi-search"
                variant="search"
                title="Petugas Tidak Ditemukan"
                message="Tidak ada petugas yang cocok dengan pencarian Anda.<br>Coba gunakan kata kunci lain atau reset filter."
                actionText="Reset Pencarian"
                actionId="resetFilterBtn"
                actionStyle="outline"
                :hidden="true" />

            {{-- HIDDEN TABLE (ENGINE) --}}
            <table id="petugasTable" class="d-none">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>HTML</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->username }}</td>
                            <td>{{ $d->email }}</td>
                            <td>
                                {{-- CARD --}}
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="modern-card">

                                        <img src="{{ asset('assets/img/avatar.png') }}"
                                            class="avatar-img">

                                        <h5 class="patient-name">{{ $d->username }}</h5>

                                        <div class="patient-info">
                                            <span>{{ $d->email }}</span>
                                            <span>Petugas Aktif</span>
                                        </div>

                                        <span class="status-badge success">
                                            Aktif
                                        </span>

                                        <div class="card-actions">

                                            {{-- DETAIL --}}
                                            <button class="btn btn-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#detail-{{ $d->id }}">
                                                <i class="bi bi-eye"></i>
                                            </button>

                                            {{-- EDIT --}}
                                            <button class="btn btn-primary btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $d->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            {{-- DELETE --}}
                                            <form method="POST"
                                                action="{{ url('kelola-petugas-hapus-' . $d->id) }}"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                {{-- MODAL DETAIL --}}
                                <x-modals.modal-kelola-petugas
                                    judul="Detail Petugas"
                                    type="detailPetugas"
                                    :d="$d" />

                                {{-- MODAL EDIT --}}
                                <x-modals.modal-kelola-petugas
                                    judul="Edit Petugas"
                                    type="editPetugas"
                                    :d="$d" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</x-app-layout>

<script>
$(document).ready(function () {

    const table = $('#petugasTable').DataTable({
        pageLength: 6,
        dom: 'tp',
        order: []
    });

    function renderCards() {
        const container = $('#petugasCards');
        container.html('');

        const rows = table.rows({ page: 'current' });

        if (rows.count() === 0 && table.data().count() > 0) {
            $('#noResultState').show();
            container.hide();
        } else {
            $('#noResultState').hide();
            container.show();
            rows.every(function () {
                container.append(this.data()[2]);
            });
        }
    }

    table.on('draw', renderCards);
    renderCards();

    // Live Search
    $('#searchPetugas').on('keyup', function () {
        table.search(this.value).draw();
    });

    // Reset Filter
    $('#resetFilterBtn').on('click', function () {
        $('#searchPetugas').val('');
        table.search('').draw();
    });

    // Delete Confirmation
    $(document).on('submit', '.delete-form', function (e) {
        e.preventDefault();
        const form = this;

        Swal.fire({
            title: 'Yakin hapus petugas?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then(result => {
            if (result.isConfirmed) form.submit();
        });
    });

    // Flash Message
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}"
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}"
        });
    @endif

});
</script>
