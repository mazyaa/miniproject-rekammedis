@if ($type === 'tambah')
    {{-- ! Modal Tambah --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahDesaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahDesaLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-desa-tambah') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="modal-input-wrap">
                            <label for="nama_desa">Nama Desa</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $iconHome !!}</svg>
                                <input type="text" name="nama_desa" id="nama_desa" class="modal-field"
                                    placeholder="Masukkan nama desa" required />
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
@elseif (($type === 'edit') && isset($d))
    {{-- ! Modal Edit --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editDesaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editDesaLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-desa-edit-' . $d->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="modal-input-wrap">
                            <label for="nama_desa-{{ $d->id }}">Nama Desa</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $iconHome !!}</svg>
                                <input type="text" name="nama_desa" id="nama_desa-{{ $d->id }}" class="modal-field"
                                    placeholder="Masukkan nama desa" value="{{ $d->nama_desa }}" required />
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
