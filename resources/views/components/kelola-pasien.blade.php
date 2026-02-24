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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i
                                class="bi bi-plus"></i> Tambah</button>
                    </div>
                    <x-modals.modal-kelola-pasien judul="Tambah Data Pasien" route="" :desa="$desa"
                        :jeniskelamin="$jeniskelamin" />
                    <div class="card-body p-0 rounded">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama Pasien</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>
                                    <th>Desa</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->nama_pasien }}</td>
                                        <td>{{ $d->jenisKelamin->deskripsi }}</td>
                                        <td>{{ $d->usia }}</td>
                                        <td>{{ $d->desa->nama_desa }}</td>
                                        <td class="text-center">
                                            @if ($d['keterangan'] === 'Hipertensi')
                                                <span
                                                    class="bg-danger text-light p-1 rounded-5 small">{{ $d->keterangan }}</span>
                                            @else
                                                <span
                                                    class="bg-success text-light p-1 rounded-5 small">{{ $d->keterangan }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <button
                                                    class="btn btn-warning btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 20px; height: 20px;">
                                                    <i class="bi bi-eye text-light" style="font-size: 10px"></i>
                                                </button>
                                                <button
                                                    class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 20px; height: 20px;">
                                                    <i class="bi bi-pencil text-light" style="font-size: 10px"></i>
                                                </button>
                                                <button
                                                    class="btn btn-danger btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 20px; height: 20px;">
                                                    <i class="bi bi-trash" style="font-size: 10px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('info'))
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            icon: 'info',
            title: 'Informasi',
            text: "{{ session('info') }}",
            confirmButtonText: 'OK',
            confirmButtonColor: '#0d6efd'
        });
    });
    </script>
    @endif
</x-app-layout>