<x-app-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-primary fw-bold">Rekam Medis</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Rekam Medis</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            {{-- TOOLBAR --}}
            <div class="d-flex flex-wrap gap-2 mb-4">
                <input type="text" id="searchPetugas" class="form-control w-auto"
                    placeholder="Cari Nama Pasien">

                <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#tambahPetugas">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>

            {{-- MODAL TAMBAH --}}
            {{-- <x-modals.modal-kelola-petugas
                judul="Tambah Data Petugas"
                type="tambahPetugas" /> --}}

            {{-- EMPTY STATE --}}
            {{-- @if ($data->isEmpty())
                <x-empty-state
                    icon="bi-person-badge"
                    title="Belum Ada Data Petugas"
                    message="Data petugas masih kosong. Mulai tambahkan data petugas<br>pertama untuk memulai pengelolaan sistem."
                    actionText="Tambah Petugas Pertama"
                    actionTarget="#tambahPetugas" />
            @endif --}}

            {{-- CARD CONTAINER --}}
            {{-- <div id="petugasCards" class="row g-4"></div> --}}

            {{-- NO SEARCH RESULT STATE (shown by JS) --}}
            {{-- <x-empty-state
                id="noResultState"
                icon="bi-search"
                variant="search"
                title="Petugas Tidak Ditemukan"
                message="Tidak ada petugas yang cocok dengan pencarian Anda.<br>Coba gunakan kata kunci lain atau reset filter."
                actionText="Reset Pencarian"
                actionId="resetFilterBtn"
                actionStyle="outline"
                :hidden="true" /> --}}

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
