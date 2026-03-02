<x-app-layout>

    {{-- HEADER --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-primary fw-bold">{{ $title }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
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

            {{-- CARD CONTAINER --}}
            <div id="petugasCards" class="row g-4"></div>

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
                                <div class="col-md-6 col-lg-4">
                                    <div class="modern-card p-3 h-100">

                                        {{-- AVATAR --}}
                                        <div class="text-center mb-3">
                                            <img src="{{ asset('assets/img/avatar.png') }}"
                                                class="avatar-img rounded-circle"
                                                style="width:80px;height:80px;">
                                        </div>

                                        {{-- INFO --}}
                                        <h5 class="text-center mb-1">{{ $d->username }}</h5>
                                        <p class="text-center text-muted small mb-3">{{ $d->email }}</p>

                                        {{-- ACTION --}}
                                        <div class="d-flex justify-content-center gap-2">

                                            {{-- EDIT --}}
                                            <button class="btn btn-primary btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editPetugas">
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

                                {{-- MODAL EDIT --}}
                                <x-modals.modal-kelola-petugas
                                    judul="Edit Data Petugas"
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
        dom: 'tp'
    });

    function renderCards() {
        const container = $('#petugasCards');
        container.html('');

        table.rows({ page: 'current' }).every(function () {
            container.append(this.data()[2]);
        });
    }

    table.on('draw', renderCards);
    renderCards();

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

});
</script>