<x-app-layout>

    {{-- HEADER --}}
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

    {{-- CONTENT --}}
    <div class="app-content">
        <div class="container-fluid">

            {{-- TOOLBAR --}}
            <div class="d-flex flex-wrap gap-2 mb-4">
                <input type="text" id="searchRekamMedis" class="form-control w-auto"
                    placeholder="Cari pasien / petugas...">

                <select id="filterKepatuhan" class="form-select w-auto">
                    <option value="">Semua Kepatuhan</option>
                    <option value="Patuh">Patuh</option>
                    <option value="Tidak Patuh">Tidak Patuh</option>
                </select>

                <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#tambahRekamMedis">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>

            {{-- MODAL TAMBAH, EDIT, DETAIL --}}
            <x-modals.modal-kelola-rekam-medis
                judul="Tambah Rekam Medis"
                type="tambah"
                :pasien="$pasien"
                :petugas="$petugas" />

            {{-- EMPTY STATE --}}
            @if ($data->isEmpty())
                <x-empty-state
                    icon="bi-journal-medical"
                    titleEmpty="Belum Ada Rekam Medis"
                    message="Data rekam medis masih kosong, silakan tambahkan rekam medis pertama Anda."
                    actionText="Tambah Rekam Medis Pertama"
                    actionTarget="#tambahRekamMedis" />
            @endif

            {{-- CARD CONTAINER --}}
            <div id="rekamMedisCards" class="row g-4"></div>

            {{-- NO SEARCH RESULT STATE (shown by JS) --}}
            <x-empty-state
                id="noResultState"
                icon="bi-search"
                variant="search"
                title="Rekam Medis Tidak Ditemukan"
                message="Tidak ada rekam medis yang cocok dengan pencarian atau filter Anda.<br>Coba gunakan kata kunci lain atau reset filter."
                actionText="Reset Pencarian"
                actionId="resetFilterBtn"
                actionStyle="outline"
                :hidden="true" />

            {{-- HIDDEN TABLE (ENGINE) --}}
            <table id="rekamMedisTable" class="d-none">
                <thead>
                    <tr>
                        <th>Pasien</th>
                        <th>Kepatuhan</th>
                        <th>HTML</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->pasien?->nama_pasien ?? '-' }}</td>
                            <td>{{ $d->kepatuhan }}</td>
                            <td>
                                {{-- CARD --}}
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="modern-card">

                                        @php
                                            $gender = strtolower($d->pasien->jenisKelamin->deskripsi ?? '');

                                            if ($gender === 'laki-laki') {
                                                $avatars = ['avatar.png', 'avatar4.png', 'avatar5.png'];
                                            } else {
                                                $avatars = ['avatar2.png', 'avatar3.png'];
                                            }

                                            $randomAvatar = $avatars[array_rand($avatars)];
                                        @endphp

                                        <img src="{{ asset('assets/img/' . $randomAvatar) }}"
                                            class="avatar-img">

                                        <h5 class="patient-name">{{ $d->pasien?->nama_pasien ?? '-' }}</h5>

                                        <div class="patient-info">
                                            <span>{{ optional($d->tanggal_kunjungan)->format('d M Y') ?? '-' }}</span>
                                            <span>TD {{ $d->sistolik }}/{{ $d->diastolik }} mmHg</span>
                                            <span>Petugas: {{ $d->petugas?->username ?? '-' }}</span>
                                        </div>

                                        <span class="status-badge {{ strtolower($d->kepatuhan) === 'patuh' ? 'success' : 'danger' }}">
                                            {{ $d->kepatuhan }}
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
                                                action="{{ url('kelola-rekam-medis-hapus-' . $d->id) }}"
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
                                <x-modals.modal-kelola-rekam-medis
                                    judul="Detail Rekam Medis"
                                    type="detail"
                                    :d="$d"
                                    :pasien="$pasien"
                                    :petugas="$petugas" />

                                {{-- MODAL EDIT --}}
                                <x-modals.modal-kelola-rekam-medis
                                    judul="Edit Rekam Medis"
                                    type="edit"
                                    :d="$d"
                                    :pasien="$pasien"
                                    :petugas="$petugas" />
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

    const table = $('#rekamMedisTable').DataTable({
        pageLength: 6,
        dom: 'tp',
        order: [] // order by newest created_at
    });

    function renderCards() {
        const container = $('#rekamMedisCards');
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
    $('#searchRekamMedis').on('keyup', function () {
        table.search(this.value).draw();
    });

    // Filter Kepatuhan
    $('#filterKepatuhan').on('change', function () {
        table.column(1).search(this.value).draw();
    });

    // Reset Filter
    $('#resetFilterBtn').on('click', function () {
        $('#searchRekamMedis').val('');
        $('#filterKepatuhan').val('');
        table.search('').column(1).search('').draw();
    });

    // Delete Confirmation
    $(document).on('submit', '.delete-form', function (e) {
        e.preventDefault();
        const form = this;

        Swal.fire({
            title: 'Yakin hapus rekam medis?',
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
