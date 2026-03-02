@php
    $code = 503;
    $title = 'Layanan Tidak Tersedia';
    $description = 'Sistem sedang dalam pemeliharaan terjadwal atau mengalami peningkatan beban. Kami sedang bekerja untuk memulihkan layanan sesegera mungkin. Terima kasih atas kesabaran Anda.';
    $cards = [
        [
            'icon' => 'bi-gear-wide-connected',
            'title' => 'Pemeliharaan',
            'text' => 'Sistem sedang menjalani pemeliharaan rutin untuk peningkatan.'
        ],
        [
            'icon' => 'bi-graph-up',
            'title' => 'Beban Tinggi',
            'text' => 'Server mungkin sedang menangani lonjakan traffic yang tinggi.'
        ],
        [
            'icon' => 'bi-clock',
            'title' => 'Segera Kembali',
            'text' => 'Layanan akan kembali normal dalam waktu dekat.'
        ]
    ];
    $variant = 'error-maintenance';
    $statusText = 'Maintenance Mode — Layanan Offline Sementara';
    $statusDot = 'warning';
@endphp

@include('layouts.error', compact('code', 'title', 'description', 'cards', 'variant', 'statusText', 'statusDot'))
