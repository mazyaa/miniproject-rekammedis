<x-app-layout>

    {{-- HEADER --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-primary fw-bold">Kelola Pasien</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Pasien</li>
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
                <input type="text" id="searchPasien" class="form-control w-auto"
                    placeholder="Cari nama pasien...">

                <select id="filterStatus" class="form-select w-auto">
                    <option value="">Semua Status</option>
                    <option value="Hipertensi">Hipertensi</option>
                    <option value="Normal">Normal</option>
                </select>

                <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#tambahPasien">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>

            {{-- MODAL TAMBAH --}}
            <x-modals.modal-kelola-pasien
                judul="Tambah Data Pasien"
                type="tambah"
                :desa="$desa"
                :jeniskelamin="$jeniskelamin" />

            {{-- EMPTY STATE --}}
            @if ($data->isEmpty())
                <x-empty-state
                    icon="bi-people"
                    title="Belum Ada Data Pasien"
                    message="Data pasien masih kosong. Mulai tambahkan data pasien<br>pertama untuk memulai pengelolaan rekam medis."
                    actionText="Tambah Pasien Pertama"
                    actionTarget="#tambahPasien" />
            @endif

            {{-- CARD CONTAINER --}}
            <div id="pasienCards" class="row g-4"></div>

            {{-- NO SEARCH RESULT STATE (shown by JS) --}}
            <x-empty-state
                id="noResultState"
                icon="bi-search"
                variant="search"
                title="Pasien Tidak Ditemukan"
                message="Tidak ada pasien yang cocok dengan pencarian atau filter Anda.<br>Coba gunakan kata kunci lain atau reset filter."
                actionText="Reset Pencarian"
                actionId="resetFilterBtn"
                actionStyle="outline"
                :hidden="true" />

            {{-- HIDDEN TABLE (ENGINE) --}}
            <table id="pasienTable" class="d-none">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>HTML</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->nama_pasien }}</td>
                            <td>{{ $d->keterangan }}</td>
                            <td>
                                {{-- CARD --}}
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="modern-card">

                                        @php
                                            $gender = strtolower($d->jenisKelamin->deskripsi ?? '');

                                            if ($gender == 'laki-laki' || $gender == 'cowo') {
                                                $avatars = ['avatar.png', 'avatar4.png', 'avatar5.png'];
                                            } else {
                                                $avatars = ['avatar2.png', 'avatar3.png'];
                                            }

                                            $randomAvatar = $avatars[array_rand($avatars)];
                                        @endphp

                                        <img src="{{ asset('assets/img/' . $randomAvatar) }}"
                                            class="avatar-img">

                                        <h5 class="patient-name">{{ $d->nama_pasien }}</h5>

                                        <div class="patient-info">
                                            <span>{{ $d->jenisKelamin->deskripsi ?? '-' }}</span>
                                            <span>{{ $d->usia }} Tahun</span>
                                            <span>{{ $d->desa->nama_desa ?? '-' }}</span>
                                        </div>

                                        <span class="status-badge {{ $d->keterangan === 'Hipertensi' ? 'danger' : 'success' }}">
                                            {{ $d->keterangan }}
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
                                                action="{{ url('kelola-pasien-hapus-' . $d->id) }}"
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
                                <x-modals.modal-kelola-pasien
                                    judul="Detail Pasien"
                                    type="detail"
                                    :d="$d"
                                    :desa="$desa"
                                    :jeniskelamin="$jeniskelamin" />

                                {{-- MODAL EDIT --}}
                                <x-modals.modal-kelola-pasien
                                    judul="Edit Pasien"
                                    type="edit"
                                    :d="$d"
                                    :desa="$desa"
                                    :jeniskelamin="$jeniskelamin" />
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

    const table = $('#pasienTable').DataTable({
        pageLength: 6,
        dom: 'tp'
    });

    // for shoeing cards instead of table rows if data 
    function renderCards() {
        const container = $('#pasienCards');
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
    $('#searchPasien').on('keyup', function () {
        table.search(this.value).draw();
    });

    // Filter Status
    $('#filterStatus').on('change', function () {
        table.column(1).search(this.value).draw();
    });

    // Reset Filter
    $('#resetFilterBtn').on('click', function () {
        $('#searchPasien').val('');
        $('#filterStatus').val('');
        table.search('').column(1).search('').draw();
    });

    // Delete Confirmation
    $(document).on('submit', '.delete-form', function (e) {
        e.preventDefault();
        const form = this;

        Swal.fire({
            title: 'Yakin hapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then(result => {
            if (result.isConfirmed) form.submit();
        });
    });

    // Flash Message
    if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}"
        });
    endif

    if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}"
        });
    endif

});
</script>
