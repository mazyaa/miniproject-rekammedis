@php
    $code = 401;
    $title = 'Tidak Terautentikasi';
    $description = 'Anda harus login terlebih dahulu untuk mengakses halaman ini. Silakan masuk dengan akun Anda atau daftar jika belum memiliki akun.';
    $cards = [
        [
            'icon' => 'bi-person-x',
            'title' => 'Belum Login',
            'text' => 'Halaman ini memerlukan autentikasi pengguna.'
        ],
        [
            'icon' => 'bi-box-arrow-in-right',
            'title' => 'Silakan Login',
            'text' => 'Masuk dengan username dan password Anda.'
        ],
        [
            'icon' => 'bi-key',
            'title' => 'Lupa Password?',
            'text' => 'Gunakan fitur reset password jika lupa.'
        ]
    ];
    $primaryAction = [
        'url' => url('/'),
        'icon' => 'bi-box-arrow-in-right',
        'text' => 'Login Sekarang'
    ];
    $variant = 'error-auth';
@endphp

@include('layouts.error', compact('code', 'title', 'description', 'cards', 'variant', 'primaryAction'))
