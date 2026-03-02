@if ($type === "tambah")
    {{-- ! Modal Tambah --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahJKLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahJKLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-jenis-kelamin-tambah') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="modal-input-wrap">
                            <label for="deskripsi">Jenis Kelamin</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $iconUsers !!}</svg>
                                <input type="text" name="deskripsi" id="deskripsi" class="modal-field"
                                    placeholder="Masukkan jenis kelamin" required />
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
    <div class="modal fade" id="edit-{{ $d->id }}" tabindex="-1" aria-labelledby="editJKLabel-{{ $d->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editJKLabel-{{ $d->id }}">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-jenis-kelamin-edit-' . $d->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="modal-input-wrap">
                            <label for="deskripsi-{{ $d->id }}">Jenis Kelamin</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $iconUsers !!}</svg>
                                <input type="text" name="deskripsi" id="deskripsi-{{ $d->id }}" class="modal-field"
                                    placeholder="Masukkan jenis kelamin" value="{{ $d->deskripsi }}" required />
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
