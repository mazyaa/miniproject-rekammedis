<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title text-light fs-5" id="exampleModalLabel">{{ $judul }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/kelola-pasien') }}">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="nama_pasien" class="col-sm-3 col-form-label text-primary"
                                style="font-size: 15px">Nama
                                Pasien</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-none" style="font-size: 13px"
                                    placeholder="Masukan nama pasien" id="nama_pasien" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nik" class="col-sm-3 col-form-label text-primary" style="font-size: 15px">NIK
                            </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control border-none" style="font-size: 13px"
                                    placeholder="Masukan nik pasien" id="nik" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jenis_kelamin_id" class="col-sm-3 col-form-label text-primary"
                                style="font-size: 15px">Jenis
                                Kelamin
                            </label>
                            <div class="col-sm-9">
                                <select class="form-select" name="jenis_kelamin_id" style="font-size: 12px" required>
                                    <option style="font-size: 12px" selected disabled>Pilih Opsi</option>
                                    @foreach ($jeniskelamin as $jk)
                                        <option style="font-size: 12px" value="{{ $jk->id }}">{{ $jk->deskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal_lahir" class="col-sm-3 col-form-label text-primary"
                                style="font-size: 15px">Tanggal
                                Lahir
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-none" style="font-size: 13px"
                                    placeholder="Masukan tanggal lahir pasien" id="tanggal_lahir" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="usia" class="col-sm-3 col-form-label text-primary"
                                style="font-size: 15px">Usia</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-none" style="font-size: 13px"
                                    placeholder="Masukan usia pasien" id="usia" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat" class="col-sm-3 col-form-label text-primary"
                                style="font-size: 15px">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-none" style="font-size: 13px"
                                    placeholder="Masukan alamat pasien" id="alamat" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="desa_id" class="col-sm-3 col-form-label text-primary"
                                style="font-size: 15px">Desa
                            </label>
                            <div class="col-sm-9">
                                <select class="form-select" name="desa_id" style="font-size: 12px" required>
                                    <option style="font-size: 12px" selected disabled>Pilih Opsi</option>
                                    @foreach ($desa as $jk)
                                        <option style="font-size: 12px" value="{{ $jk->id }}">{{ $jk->nama_desa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="usia" class="col-sm-3 col-form-label text-primary"
                                style="font-size: 15px">Usia</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-none" style="font-size: 13px"
                                    placeholder="Masukan usia pasien" id="usia" />
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