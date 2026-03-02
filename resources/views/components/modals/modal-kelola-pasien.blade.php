@if ($type === 'tambah')
    {{-- ! Modal Tambah --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title text-light fs-5" id="exampleModalLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-pasien-tambah') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="nama_pasien" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Nama Pasien
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_pasien" class="form-control border-none"
                                        style="font-size: 13px" placeholder="Masukan Nama Pasien" id="nama_pasien"
                                        value="{{ old('nama_pasien') }}" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nik" class="col-sm-3 col-form-label text-primary" style="font-size: 15px">NIK
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="nik" class="form-control border-none"
                                        style="font-size: 13px" placeholder="Masukan NIK Pasien" id="nik"
                                        value="{{ old('nik') }}" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis_kelamin_id" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Jenis Kelamin
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="jenis_kelamin_id" style="font-size: 12px"
                                        required>
                                        <option style="font-size: 12px" selected disabled>Pilih Opsi</option>
                                        @foreach ($jeniskelamin as $jk)
                                            <option style="font-size: 12px" value="{{ $jk->id }}"
                                                {{ old('jenis_kelamin_id') == $jk->id ? 'selected' : '' }}>
                                                {{ $jk->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_lahir" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Tanggal Lahir
                                </label>
                                <div class="col-sm-9">
                                    <input type="date" name="tanggal_lahir" class="form-control border-none"
                                        style="font-size: 13px" id="tanggal_lahir"
                                        value="{{ old('tanggal_lahir') }}" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="usia" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Usia</label>
                                <div class="col-sm-9">
                                    <input type="number" name="usia" class="form-control border-none"
                                        style="font-size: 13px" placeholder="Masukan Usia Pasien" id="usia"
                                        value="{{ old('usia') }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="alamat" class="form-control border-none"
                                        style="font-size: 13px" placeholder="Masukan Alamat Pasien" id="alamat"
                                        value="{{ old('alamat') }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="desa_id" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Desa
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="desa_id" style="font-size: 12px" required>
                                        <option style="font-size: 12px" selected disabled>Pilih Opsi</option>
                                        @foreach ($desa as $d)
                                            <option style="font-size: 12px" value="{{ $d->id }}"
                                                {{ old('desa_id') == $d->id ? 'selected' : '' }}>
                                                {{ $d->nama_desa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_hp" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">No. HP</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_hp" class="form-control border-none"
                                        style="font-size: 13px" placeholder="Masukan No. HP Pasien" id="no_hp"
                                        value="{{ old('no_hp') }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keterangan" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Keterangan</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="keterangan" style="font-size: 12px" required>
                                        <option style="font-size: 12px" selected disabled>Pilih Status</option>
                                        <option style="font-size: 12px" value="Sehat"
                                            {{ old('keterangan') == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                                        <option style="font-size: 12px" value="Hipertensi"
                                            {{ old('keterangan') == 'Hipertensi' ? 'selected' : '' }}>Hipertensi</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@elseif (($type === 'detail') && isset($pasien))
    {{-- ! Modal Detail --}}
    <div class="modal fade" id="detail-{{ $pasien->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h1 class="modal-title text-light fs-5" id="exampleModalLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-primary" style="font-size: 15px">Nama Pasien
                            </label>
                            <div class="col-sm-9">
                                <p style="font-size: 13px">{{ $pasien->nama_pasien }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-primary" style="font-size: 15px">NIK
                            </label>
                            <div class="col-sm-9">
                                <p style="font-size: 13px">{{ $pasien->nik }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-primary" style="font-size: 15px">Jenis Kelamin
                            </label>
                            <div class="col-sm-9">
                                <p style="font-size: 13px">{{ $pasien->jenisKelamin->deskripsi }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-primary" style="font-size: 15px">Tanggal Lahir
                            </label>
                            <div class="col-sm-9">
                                <p style="font-size: 13px">{{ $pasien->tanggal_lahir->format('d-m-Y') }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-primary" style="font-size: 15px">Usia</label>
                            <div class="col-sm-9">
                                <p style="font-size: 13px">{{ $pasien->usia }} Tahun</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-primary" style="font-size: 15px">Alamat</label>
                            <div class="col-sm-9">
                                <p style="font-size: 13px">{{ $pasien->alamat }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-primary" style="font-size: 15px">Desa
                            </label>
                            <div class="col-sm-9">
                                <p style="font-size: 13px">{{ $pasien->desa->nama_desa }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-primary" style="font-size: 15px">No. HP</label>
                            <div class="col-sm-9">
                                <p style="font-size: 13px">{{ $pasien->no_hp ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label text-primary" style="font-size: 15px">Keterangan</label>
                            <div class="col-sm-9">
                                @if ($pasien->keterangan === 'Hipertensi')
                                    <span class="bg-danger text-light p-1 rounded-5 small">{{ $pasien->keterangan }}</span>
                                @else
                                    <span class="bg-success text-light p-1 rounded-5 small">{{ $pasien->keterangan }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@elseif (($type === 'edit') && isset($pasien))
    {{-- ! Modal Edit --}}
    <div class="modal fade" id="edit-{{ $pasien->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title text-light fs-5" id="exampleModalLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-pasien-edit-' . $pasien->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="nama_pasien" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Nama Pasien
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_pasien" class="form-control border-none"
                                        style="font-size: 13px" id="nama_pasien" value="{{ $pasien->nama_pasien }}"
                                        required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nik" class="col-sm-3 col-form-label text-primary" style="font-size: 15px">NIK
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="nik" class="form-control border-none"
                                        style="font-size: 13px" id="nik" value="{{ $pasien->nik }}" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis_kelamin_id" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Jenis Kelamin
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="jenis_kelamin_id" style="font-size: 12px"
                                        required>
                                        <option style="font-size: 12px" selected disabled>Pilih Opsi</option>
                                        @foreach ($jeniskelamin as $jk)
                                            <option style="font-size: 12px" value="{{ $jk->id }}"
                                                {{ $pasien->jenis_kelamin_id == $jk->id ? 'selected' : '' }}>
                                                {{ $jk->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_lahir" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Tanggal Lahir
                                </label>
                                <div class="col-sm-9">
                                    <input type="date" name="tanggal_lahir" class="form-control border-none"
                                        style="font-size: 13px" id="tanggal_lahir"
                                        value="{{ $pasien->tanggal_lahir->format('Y-m-d') }}" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="usia" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Usia</label>
                                <div class="col-sm-9">
                                    <input type="number" name="usia" class="form-control border-none"
                                        style="font-size: 13px" id="usia" value="{{ $pasien->usia }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="alamat" class="form-control border-none"
                                        style="font-size: 13px" id="alamat" value="{{ $pasien->alamat }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="desa_id" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Desa
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="desa_id" style="font-size: 12px" required>
                                        <option style="font-size: 12px" selected disabled>Pilih Opsi</option>
                                        @foreach ($desa as $d)
                                            <option style="font-size: 12px" value="{{ $d->id }}"
                                                {{ $pasien->desa_id == $d->id ? 'selected' : '' }}>
                                                {{ $d->nama_desa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_hp" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">No. HP</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_hp" class="form-control border-none"
                                        style="font-size: 13px" id="no_hp" value="{{ $pasien->no_hp }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="keterangan" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Keterangan</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="keterangan" style="font-size: 12px" required>
                                        <option style="font-size: 12px" selected disabled>Pilih Status</option>
                                        <option style="font-size: 12px" value="Sehat"
                                            {{ $pasien->keterangan == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                                        <option style="font-size: 12px" value="Hipertensi"
                                            {{ $pasien->keterangan == 'Hipertensi' ? 'selected' : '' }}>Hipertensi
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
