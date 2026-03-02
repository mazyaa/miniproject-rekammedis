@php
    $code = 403;
    $title = 'Akses Ditolak';
    $description = 'Anda tidak memiliki izin untuk mengakses halaman ini. Silakan login dengan akun yang memiliki hak akses atau hubungi administrator untuk mendapatkan akses yang diperlukan.';
    $cards = [
        [
            'icon' => 'bi-shield-lock',
            'title' => 'Akses Terbatas',
            'text' => 'Halaman ini hanya dapat diakses oleh pengguna dengan hak akses tertentu.'
        ],
        [
            'icon' => 'bi-person-check',
            'title' => 'Verifikasi Akun',
            'text' => 'Pastikan Anda sudah login dengan akun yang memiliki izin akses.'
        ],
        [
            'icon' => 'bi-headset',
            'title' => 'Hubungi Admin',
            'text' => 'Jika Anda merasa seharusnya memiliki akses, hubungi administrator sistem.'
        ]
    ];
    $variant = 'error-forbidden';
@endphp

@include('layouts.error', compact('code', 'title', 'description', 'cards', 'variant'))
