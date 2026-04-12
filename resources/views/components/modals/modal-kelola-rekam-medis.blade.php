@php
    $icons = [
        'user' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
        'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
        'activity' => '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>',
        'clipboard' => '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>',
        'pill' => '<path d="M4.22 4.22a3 3 0 0 1 4.24 0l11.32 11.32a3 3 0 0 1-4.24 4.24L4.22 8.46a3 3 0 0 1 0-4.24z"/><line x1="9" y1="9" x2="15" y2="15"/>',
    ];
@endphp

@if ($type === 'tambah')
    <div class="modal fade" id="tambahRekamMedis" tabindex="-1" aria-labelledby="tambahRekamMedisLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahRekamMedisLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-rekam-medis-tambah') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="modal-input-wrap">
                            <label for="pasien_id">Pasien</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                                <select name="pasien_id" id="pasien_id" class="modal-field" required>
                                    <option value="" selected disabled>Pilih pasien</option>
                                    @foreach ($pasien as $p)
                                        <option value="{{ $p->id }}" {{ old('pasien_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama_pasien }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="petugas_id">Petugas</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                                <select name="petugas_id" id="petugas_id" class="modal-field" required>
                                    <option value="" selected disabled>Pilih petugas</option>
                                    @foreach ($petugas as $ptg)
                                        <option value="{{ $ptg->id }}" {{ old('petugas_id') == $ptg->id ? 'selected' : '' }}>
                                            {{ $ptg->username }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['calendar'] !!}</svg>
                                <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="modal-field"
                                    value="{{ old('tanggal_kunjungan') }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="sistolik">Sistolik</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['activity'] !!}</svg>
                                <input type="number" name="sistolik" id="sistolik" class="modal-field"
                                    placeholder="Contoh: 120" value="{{ old('sistolik') }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="diastolik">Diastolik</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['activity'] !!}</svg>
                                <input type="number" name="diastolik" id="diastolik" class="modal-field"
                                    placeholder="Contoh: 80" value="{{ old('diastolik') }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="kepatuhan">Kepatuhan</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['clipboard'] !!}</svg>
                                <select name="kepatuhan" id="kepatuhan" class="modal-field" required>
                                    <option value="" selected disabled>Pilih kepatuhan</option>
                                    <option value="Patuh" {{ old('kepatuhan') == 'Patuh' ? 'selected' : '' }}>Patuh</option>
                                    <option value="Tidak Patuh" {{ old('kepatuhan') == 'Tidak Patuh' ? 'selected' : '' }}>Tidak Patuh</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="obat_diberikan">Obat Diberikan</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['pill'] !!}</svg>
                                <input type="text" name="obat_diberikan" id="obat_diberikan" class="modal-field"
                                    placeholder="Masukkan obat yang diberikan" value="{{ old('obat_diberikan') }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="keterangan">Keterangan</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['clipboard'] !!}</svg>
                                <textarea name="keterangan" id="keterangan" class="modal-field" rows="2"
                                    placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
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

@elseif (($type === 'detail') && isset($d))
    <div class="modal fade" id="detail-{{ $d->id }}" tabindex="-1" aria-labelledby="detailRekamMedisLabel-{{ $d->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <h1 class="modal-title fs-5" id="detailRekamMedisLabel-{{ $d->id }}">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="modal-input-wrap">
                        <label>Pasien</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->pasien?->nama_pasien ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Petugas</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->petugas?->username ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Tanggal Kunjungan</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['calendar'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->tanggal_kunjungan ? $d->tanggal_kunjungan->format('d-m-Y') : '-' }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Tekanan Darah</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['activity'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->sistolik }}/{{ $d->diastolik }} mmHg</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Kepatuhan</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['clipboard'] !!}</svg>
                            <div class="modal-detail-value">
                                <span class="status-badge {{ strtolower($d->kepatuhan) === 'patuh' ? 'success' : 'danger' }}" style="margin: 0;">
                                    {{ $d->kepatuhan }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Obat Diberikan</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['pill'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->obat_diberikan }}</div>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Keterangan</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['clipboard'] !!}</svg>
                            <div class="modal-detail-value">{{ $d->keterangan ?? '-' }}</div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-btn-cancel" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@elseif (($type === 'edit') && isset($d) && is_object($d))
    <div class="modal fade" id="edit-{{ $d->id }}" tabindex="-1" aria-labelledby="editRekamMedisLabel-{{ $d->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editRekamMedisLabel-{{ $d->id }}">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-rekam-medis-edit-' . $d->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="modal-input-wrap">
                            <label for="pasien_id-{{ $d->id }}">Pasien</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                                <select name="pasien_id" id="pasien_id-{{ $d->id }}" class="modal-field" required>
                                    <option value="" disabled>Pilih pasien</option>
                                    @foreach ($pasien as $p)
                                        <option value="{{ $p->id }}" {{ $d->pasien_id == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama_pasien }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="petugas_id-{{ $d->id }}">Petugas</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                                <select name="petugas_id" id="petugas_id-{{ $d->id }}" class="modal-field" required>
                                    <option value="" disabled>Pilih petugas</option>
                                    @foreach ($petugas as $ptg)
                                        <option value="{{ $ptg->id }}" {{ $d->petugas_id == $ptg->id ? 'selected' : '' }}>
                                            {{ $ptg->username }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="tanggal_kunjungan-{{ $d->id }}">Tanggal Kunjungan</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['calendar'] !!}</svg>
                                <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan-{{ $d->id }}" class="modal-field"
                                    value="{{ $d->tanggal_kunjungan ? $d->tanggal_kunjungan->format('Y-m-d') : '' }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="sistolik-{{ $d->id }}">Sistolik</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['activity'] !!}</svg>
                                <input type="number" name="sistolik" id="sistolik-{{ $d->id }}" class="modal-field"
                                    value="{{ $d->sistolik }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="diastolik-{{ $d->id }}">Diastolik</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['activity'] !!}</svg>
                                <input type="number" name="diastolik" id="diastolik-{{ $d->id }}" class="modal-field"
                                    value="{{ $d->diastolik }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="kepatuhan-{{ $d->id }}">Kepatuhan</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['clipboard'] !!}</svg>
                                <select name="kepatuhan" id="kepatuhan-{{ $d->id }}" class="modal-field" required>
                                    <option value="" disabled>Pilih kepatuhan</option>
                                    <option value="Patuh" {{ $d->kepatuhan == 'Patuh' ? 'selected' : '' }}>Patuh</option>
                                    <option value="Tidak Patuh" {{ $d->kepatuhan == 'Tidak Patuh' ? 'selected' : '' }}>Tidak Patuh</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="obat_diberikan-{{ $d->id }}">Obat Diberikan</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['pill'] !!}</svg>
                                <input type="text" name="obat_diberikan" id="obat_diberikan-{{ $d->id }}" class="modal-field"
                                    value="{{ $d->obat_diberikan }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="keterangan-{{ $d->id }}">Keterangan</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['clipboard'] !!}</svg>
                                <textarea name="keterangan" id="keterangan-{{ $d->id }}" class="modal-field" rows="2"
                                    placeholder="Keterangan tambahan (opsional)">{{ $d->keterangan }}</textarea>
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
