@php
    $code = 429;
    $title = 'Terlalu Banyak Permintaan';
    $description = 'Anda telah mengirim terlalu banyak permintaan dalam waktu singkat. Sistem membatasi akses untuk melindungi dari potensi serangan. Silakan tunggu beberapa menit sebelum mencoba lagi.';
    $cards = [
        [
            'icon' => 'bi-speedometer2',
            'title' => 'Rate Limit',
            'text' => 'Sistem membatasi jumlah permintaan per menit untuk keamanan.'
        ],
        [
            'icon' => 'bi-hourglass-split',
            'title' => 'Tunggu Sebentar',
            'text' => 'Coba lagi dalam beberapa menit setelah limit direset.'
        ],
        [
            'icon' => 'bi-robot',
            'title' => 'Perlindungan Bot',
            'text' => 'Pembatasan ini melindungi sistem dari aktivitas otomatis berbahaya.'
        ]
    ];
    $variant = 'error-ratelimit';
    $statusText = 'Rate Limited — Tunggu Beberapa Menit';
    $statusDot = 'warning';
@endphp

@include('layouts.error', compact('code', 'title', 'description', 'cards', 'variant', 'statusText', 'statusDot'))
