<x-app-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-primary fw-bold">Kelola Pasien</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/dashboard" class="text-black-50">Home</a></li>
                        <li class="breadcrumb-item active @if (request()->path() == 'kelola-pasien') text-primary @endif"
                            aria-current="page">Kelola Pasien</li>
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
                    <x-modals.modal-kelola-pasien judul="Tambah Data Pasien" type="tambah" :desa="$desa"
                        :jeniskelamin="$jeniskelamin" />
                    <div class="card-body p-0 rounded">
                        <table id="pasien" class="table table-striped">
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
                                                {{-- ! DETAIL --}}
                                                <button
                                                    class="btn btn-warning btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 20px; height: 20px;" data-bs-toggle="modal"
                                                    data-bs-target="#detail-{{ $d->id }}">
                                                    <i class="bi bi-eye text-light" style="font-size: 10px"></i>
                                                </button>
                                                {{-- ! UPDATE --}}
                                                <button
                                                    class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 20px; height: 20px;" data-bs-toggle="modal"
                                                    data-bs-target="#edit-{{ $d->id }}">
                                                    <i class="bi bi-pencil text-light" style="font-size: 10px"></i>
                                                </button>

                                                {{-- ! DELETE --}}
                                                <form action="{{ url('kelola-pasien-hapus-' . $d->id) }}" method="POST"
                                                    id="delete-form-{{ $d->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-id="{{ $d->id }}"
                                                        data-nama="{{ $d->nama_pasien }}" data-entity="Pasien"
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
                            <x-modals.modal-kelola-pasien judul="Detail Data Pasien" type="detail" :pasien="$d"
                                :desa="$desa" :jeniskelamin="$jeniskelamin" />
                            <x-modals.modal-kelola-pasien judul="Edit Data Pasien" type="edit" :pasien="$d"
                                :desa="$desa" :jeniskelamin="$jeniskelamin" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        new DataTable('#pasien', {
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true,
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
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
