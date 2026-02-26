@if ($type === "tambahPetugas")
<div class="modal fade" id="tambahPetugas" tabindex="-1" aria-labelledby="tambahPetugasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title text-light fs-5" id="tambahPetugasLabel">{{ $judul }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('/kelola-petugas-tambah') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="username" class="col-sm-3 col-form-label text-primary"
                                style="font-size: 15px">
                                Username
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control border-none" style="font-size: 13px"
                                    placeholder="Masukan Username Anda" id="username" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-3 col-form-label text-primary"
                                style="font-size: 15px">Email
                            </label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control border-none" style="font-size: 13px"
                                    placeholder="Masukan Email Anda" id="email" required/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="passsword" class="col-sm-3 col-form-label text-primary"
                                style="font-size: 15px">
                                Password
                            </label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control border-none" style="font-size: 13px"
                                    placeholder="Masukan Password Anda" id="password" required/>
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
@elseif (($type === 'editPetugas') && isset($d))
    {{-- ! Modal Edit --}}
    <div class="modal fade" id="editPetugas" tabindex="-1" aria-labelledby="editPetugasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title text-light fs-5" id="editPetugasLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-petugas-edit-' . $d->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="username" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">
                                    Username
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control border-none" style="font-size: 13px"
                                        placeholder="Masukan Username Anda" id="username" value="{{ $d->username }}" required/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-3 col-form-label text-primary"
                                    style="font-size: 15px">Email
                                </label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control border-none" style="font-size: 13px"
                                        placeholder="Masukan Email Anda" id="email" value="{{ $d->email }}" required/>
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
