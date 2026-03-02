@if ($type === 'tambah')
    {{-- ! Modal Tambah --}}
    <div class="modal fade" id="tambahPasien" tabindex="-1" aria-labelledby="tambahPasienLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahPasienLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-pasien-tambah') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="modal-input-wrap">
                            <label for="nama_pasien">Nama Pasien</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                                <input type="text" name="nama_pasien" id="nama_pasien" class="modal-field"
                                    placeholder="Masukkan nama pasien" value="{{ old('nama_pasien') }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="nik">NIK</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['id-card'] !!}</svg>
                                <input type="text" name="nik" id="nik" class="modal-field"
                                    placeholder="Masukkan NIK pasien" value="{{ old('nik') }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="jenis_kelamin_id">Jenis Kelamin</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['users'] !!}</svg>
                                <select name="jenis_kelamin_id" id="jenis_kelamin_id" class="modal-field" required>
                                    <option value="" selected disabled>Pilih jenis kelamin</option>
                                    @foreach ($jeniskelamin as $jk)
                                        <option value="{{ $jk->id }}" {{ old('jenis_kelamin_id') == $jk->id ? 'selected' : '' }}>
                                            {{ $jk->deskripsi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['calendar'] !!}</svg>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="modal-field"
                                    value="{{ old('tanggal_lahir') }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="usia">Usia</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['hash'] !!}</svg>
                                <input type="number" name="usia" id="usia" class="modal-field"
                                    placeholder="Masukkan usia pasien" value="{{ old('usia') }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="alamat">Alamat</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['map-pin'] !!}</svg>
                                <input type="text" name="alamat" id="alamat" class="modal-field"
                                    placeholder="Masukkan alamat pasien" value="{{ old('alamat') }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="desa_id">Desa</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['home'] !!}</svg>
                                <select name="desa_id" id="desa_id" class="modal-field" required>
                                    <option value="" selected disabled>Pilih desa</option>
                                    @foreach ($desa as $d)
                                        <option value="{{ $d->id }}" {{ old('desa_id') == $d->id ? 'selected' : '' }}>
                                            {{ $d->nama_desa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="no_hp">No. HP</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['phone'] !!}</svg>
                                <input type="text" name="no_hp" id="no_hp" class="modal-field"
                                    placeholder="Masukkan no. HP pasien" value="{{ old('no_hp') }}" />
                            </div>
                        </div>

                        {{-- <div class="modal-input-wrap">
                            <label for="keterangan">Keterangan</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['clipboard'] !!}</svg>
                                <select name="keterangan" id="keterangan" class="modal-field" required>
                                    <option value="" selected disabled>Pilih status</option>
                                    <option value="Sehat" {{ old('keterangan') == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                                    <option value="Hipertensi" {{ old('keterangan') == 'Hipertensi' ? 'selected' : '' }}>Hipertensi</option>
                                </select>
                            </div>
                        </div> --}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-btn-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="modal-btn-submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@elseif (($type === 'detail') && isset($d))
    {{-- ! Modal Detail --}}
    <div class="modal fade" id="detail-{{ $d->id }}" tabindex="-1" aria-labelledby="detailPasienLabel-{{ $d->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <h1 class="modal-title fs-5" id="detailPasienLabel-{{ $d->id }}">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="modal-input-wrap">
                        <label>Nama Pasien</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->nama_pasien }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>NIK</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['id-card'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->nik }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Jenis Kelamin</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['users'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->jenisKelamin->deskripsi }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Tanggal Lahir</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['calendar'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->tanggal_lahir->format('d-m-Y') }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Usia</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['hash'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->usia }} Tahun</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Alamat</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['map-pin'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->alamat }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Desa</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['home'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->desa->nama_desa }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>No. HP</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['phone'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->no_hp ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Keterangan</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['clipboard'] !!}</svg>
                            <div class="modal-detail-value">
                                <span class="status-badge {{ $d->keterangan === 'Hipertensi' ? 'danger' : 'success' }}" style="margin: 0;">
                                    {{ $d->keterangan }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-btn-cancel" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@elseif (($type === 'edit') && isset($d))
    {{-- ! Modal Edit --}}
    <div class="modal fade" id="edit-{{ $d->id }}" tabindex="-1" aria-labelledby="editPasienLabel-{{ $d->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPasienLabel-{{ $d->id }}">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-pasien-edit-' . $d->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="modal-input-wrap">
                            <label for="nama_pasien-{{ $d->id }}">Nama Pasien</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                                <input type="text" name="nama_pasien" id="nama_pasien-{{ $d->id }}" class="modal-field"
                                    value="{{ $d->nama_pasien }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="nik-{{ $d->id }}">NIK</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['id-card'] !!}</svg>
                                <input type="text" name="nik" id="nik-{{ $d->id }}" class="modal-field"
                                    value="{{ $d->nik }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="jenis_kelamin_id-{{ $d->id }}">Jenis Kelamin</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['users'] !!}</svg>
                                <select name="jenis_kelamin_id" id="jenis_kelamin_id-{{ $d->id }}" class="modal-field" required>
                                    <option value="" disabled>Pilih jenis kelamin</option>
                                    @foreach ($jeniskelamin as $jk)
                                        <option value="{{ $jk->id }}" {{ $d->jenis_kelamin_id == $jk->id ? 'selected' : '' }}>
                                            {{ $jk->deskripsi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="tanggal_lahir-{{ $d->id }}">Tanggal Lahir</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['calendar'] !!}</svg>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir-{{ $d->id }}" class="modal-field"
                                    value="{{ $d->tanggal_lahir->format('Y-m-d') }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="usia-{{ $d->id }}">Usia</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['hash'] !!}</svg>
                                <input type="number" name="usia" id="usia-{{ $d->id }}" class="modal-field"
                                    value="{{ $d->usia }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="alamat-{{ $d->id }}">Alamat</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['map-pin'] !!}</svg>
                                <input type="text" name="alamat" id="alamat-{{ $d->id }}" class="modal-field"
                                    value="{{ $d->alamat }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="desa_id-{{ $d->id }}">Desa</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['home'] !!}</svg>
                                <select name="desa_id" id="desa_id-{{ $d->id }}" class="modal-field" required>
                                    <option value="" disabled>Pilih desa</option>
                                    @foreach ($desa as $ds)
                                        <option value="{{ $ds->id }}" {{ $d->desa_id == $ds->id ? 'selected' : '' }}>
                                            {{ $ds->nama_desa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="no_hp-{{ $d->id }}">No. HP</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['phone'] !!}</svg>
                                <input type="text" name="no_hp" id="no_hp-{{ $d->id }}" class="modal-field"
                                    placeholder="Masukkan no. HP pasien" value="{{ $d->no_hp }}" />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="keterangan-{{ $d->id }}">Keterangan</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['clipboard'] !!}</svg>
                                <select name="keterangan" id="keterangan-{{ $d->id }}" class="modal-field" required>
                                    <option value="" disabled>Pilih status</option>
                                    <option value="Sehat" {{ $d->keterangan == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                                    <option value="Hipertensi" {{ $d->keterangan == 'Hipertensi' ? 'selected' : '' }}>Hipertensi</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-btn-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="modal-btn-submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
