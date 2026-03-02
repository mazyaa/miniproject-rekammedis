@php
    $code = 404;
    $title = 'Halaman Tidak Ditemukan';
    $description = 'Maaf, halaman yang Anda cari tidak dapat ditemukan. Halaman mungkin telah dipindahkan, dihapus, atau URL yang Anda masukkan salah. Silakan periksa kembali alamat URL atau gunakan navigasi di bawah ini.';
    $cards = [
        [
            'icon' => 'bi-link-45deg',
            'title' => 'Periksa URL',
            'text' => 'Pastikan alamat URL yang diketik sudah benar dan tidak ada kesalahan penulisan.'
        ],
        [
            'icon' => 'bi-arrow-counterclockwise',
            'title' => 'Halaman Dipindahkan',
            'text' => 'Konten mungkin telah dipindahkan ke lokasi baru dalam sistem kami.'
        ],
        [
            'icon' => 'bi-headset',
            'title' => 'Butuh Bantuan?',
            'text' => 'Hubungi administrator sistem jika masalah ini terus berlanjut.'
        ]
    ];
@endphp

@include('layouts.error', compact('code', 'title', 'description', 'cards'))

