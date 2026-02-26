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
                        <li class="breadcrumb-item active @if (request()->path() == 'kelola-petugas') text-primary @endif"
                            aria-current="page">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="card mb-4">
                    <div class="card-header">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPetugas"> <i
                                class="bi bi-plus"></i> Tambah</button>
                    </div>
                    <div class="card-body p-0 rounded">
                        <table class="table table-striped" id="petugas">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->username }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <button
                                                    class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 20px; height: 20px;" data-bs-toggle="modal"
                                                    data-bs-target="#editPetugas">
                                                    <i class="bi bi-pencil text-light" style="font-size: 10px"></i>
                                                </button>

                                                <form action="{{ url('kelola-petugas-hapus-' . $d->id) }}" method="POST"
                                                    id="delete-form-{{ $d->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-id="{{ $d->id }}"
                                                        data-nama="{{ $d->nama_desa }}" data-entity="Desa"
                                                        class="btn btn-danger btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                        style="width: 20px; height: 20px;">
                                                        <i class="bi bi-trash" style="font-size: 10px"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($data as $d)
                            <x-modals.modal-kelola-petugas judul="Tambah Data Petugas" type="tambahPetugas" />
                            <x-modals.modal-kelola-petugas judul="Edit Data Petugas" :d="$d" type="editPetugas" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            new DataTable('#petugas', {
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true,
            });
        });
    </script>
</x-app-layout>
