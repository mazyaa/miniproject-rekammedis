<x-app-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-primary fw-bold">{{ $title }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"> <i
                                class="bi bi-plus"></i> Tambah</button>
                    </div>
                    <div class="card-body p-0 rounded">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama Pasien</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->nama_desa }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                {{-- ! UPDATE --}}
                                                <button
                                                    class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 20px; height: 20px;" data-bs-toggle="modal"
                                                    data-bs-target="#edit">
                                                    <i class="bi bi-pencil text-light" style="font-size: 10px"></i>
                                                </button>

                                                {{-- ! DELLETE --}}
                                                <form action="{{ url('kelola-desa-hapus-' . $d->id) }}" method="POST"
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
                            <x-modals.modal-kelola-desa judul="Tambah Data Desa" type="tambah" />
                            <x-modals.modal-kelola-desa judul="Edit Data Desa" type="edit" :d="$d" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>