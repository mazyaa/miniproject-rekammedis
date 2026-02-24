@if ($type === "tambah")
    {{-- ! Modal Tambah --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title text-light fs-5" id="exampleModalLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-desa-tambah') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="nama_desa" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Desa
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_desa" class="form-control border-none"
                                        style="font-size: 13px" placeholder="Masukan Nama Desa" id="nama_desa" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@elseif (($type === 'edit') && isset($d))
    {{-- ! Modal Edit --}}
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title text-light fs-5" id="exampleModalLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-desa-edit-' . $d->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="nama_desa" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Desa
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_desa" class="form-control border-none"
                                        style="font-size: 13px" placeholder="Masukan Nama Desa" id="nama_desa"
                                        value="{{ $d->nama_desa }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif