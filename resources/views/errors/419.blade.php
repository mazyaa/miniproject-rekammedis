@php
    $code = 419;
    $title = 'Sesi Telah Berakhir';
    $description = 'Sesi Anda telah kedaluwarsa karena tidak ada aktivitas dalam waktu yang lama. Demi keamanan data, silakan muat ulang halaman dan login kembali untuk melanjutkan.';
    $cards = [
        [
            'icon' => 'bi-clock-history',
            'title' => 'Waktu Habis',
            'text' => 'Sesi otomatis berakhir setelah periode tidak aktif untuk keamanan.'
        ],
        [
            'icon' => 'bi-arrow-clockwise',
            'title' => 'Muat Ulang',
            'text' => 'Refresh halaman untuk mendapatkan token sesi yang baru.'
        ],
        [
            'icon' => 'bi-shield-check',
            'title' => 'Keamanan Data',
            'text' => 'Fitur ini melindungi data Anda dari akses yang tidak sah.'
        ]
    ];
    $primaryAction = [
        'url' => url('/'),
        'icon' => 'bi-box-arrow-in-right',
        'text' => 'Login Kembali'
    ];
    $variant = 'error-session';
@endphp

@include('layouts.error', compact('code', 'title', 'description', 'cards', 'variant', 'primaryAction'))
