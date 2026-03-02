@php
    $code = 500;
    $title = 'Kesalahan Server';
    $description = 'Terjadi kesalahan pada server kami. Tim teknis sudah diberitahu dan sedang menangani masalah ini. Silakan coba lagi dalam beberapa saat atau hubungi administrator jika masalah berlanjut.';
    $cards = [
        [
            'icon' => 'bi-exclamation-triangle',
            'title' => 'Kesalahan Sistem',
            'text' => 'Server mengalami kesalahan internal yang sedang ditangani.'
        ],
        [
            'icon' => 'bi-tools',
            'title' => 'Sedang Diperbaiki',
            'text' => 'Tim teknis sedang bekerja untuk memperbaiki masalah ini.'
        ],
        [
            'icon' => 'bi-arrow-repeat',
            'title' => 'Coba Lagi',
            'text' => 'Silakan muat ulang halaman atau coba lagi dalam beberapa menit.'
        ]
    ];
    $variant = 'error-server';
    $statusText = 'Server Error — Pemeliharaan Aktif';
    $statusDot = 'danger';
@endphp

@include('layouts.error', compact('code', 'title', 'description', 'cards', 'variant', 'statusText', 'statusDot'))
