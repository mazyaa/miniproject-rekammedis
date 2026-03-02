@php
    $icons = [
        'user'     => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
        'email'    => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>',
        'password' => '<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
    ];
@endphp

@if ($type === "tambahPetugas")
    <div class="modal fade" id="tambahPetugas" tabindex="-1" aria-labelledby="tambahPetugasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahPetugasLabel">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-petugas-tambah') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="modal-input-wrap">
                            <label for="username">Username</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                                <input type="text" name="username" id="username" class="modal-field"
                                    placeholder="Masukkan username" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="email">Email</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['email'] !!}</svg>
                                <input type="email" name="email" id="email" class="modal-field"
                                    placeholder="Masukkan email" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="password">Password</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['password'] !!}</svg>
                                <input type="password" name="password" id="password" class="modal-field"
                                    placeholder="Masukkan password" required />
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
@elseif (($type === 'detailPetugas') && isset($d))
    {{-- ! Modal Detail --}}
    <div class="modal fade" id="detail-{{ $d->id }}" tabindex="-1" aria-labelledby="detailPetugasLabel-{{ $d->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailPetugasLabel-{{ $d->id }}">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {{-- Avatar --}}
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/img/avatar.png') }}"
                            class="avatar-img rounded-circle"
                            style="width:100px; height:100px; border:3px solid #e0e0e0;">
                        <h4 class="mt-3 mb-0">{{ $d->username }}</h4>
                        <small class="text-muted">Petugas</small>
                    </div>

                    <hr>

                    <div class="modal-input-wrap">
                        <label>Username</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                            <span class="modal-detail-value">{{ $d->username }}</span>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Email</label>
                        <div class="modal-input-inner">
                            <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['email'] !!}</svg>
                            <span class="modal-detail-value">{{ $d->email }}</span>
                        </div>
                    </div>

                    <div class="modal-input-wrap">
                        <label>Status</label>
                        <div class="modal-input-inner">
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-btn-cancel" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@elseif (($type === 'editPetugas') && isset($d) && is_object($d))
    {{-- ! Modal Edit --}}
    <div class="modal fade" id="edit-{{ $d->id }}" tabindex="-1" aria-labelledby="editPetugasLabel-{{ $d->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPetugasLabel-{{ $d->id }}">{{ $judul }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/kelola-petugas-edit-' . $d->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="modal-input-wrap">
                            <label for="username-{{ $d->id }}">Username</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['user'] !!}</svg>
                                <input type="text" name="username" id="username-{{ $d->id }}" class="modal-field"
                                    placeholder="Masukkan username" value="{{ $d->username }}" required />
                            </div>
                        </div>

                        <div class="modal-input-wrap">
                            <label for="email-{{ $d->id }}">Email</label>
                            <div class="modal-input-inner">
                                <svg class="modal-input-icon" viewBox="0 0 24 24">{!! $icons['email'] !!}</svg>
                                <input type="email" name="email" id="email-{{ $d->id }}" class="modal-field"
                                    placeholder="Masukkan email" value="{{ $d->email }}" required />
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
