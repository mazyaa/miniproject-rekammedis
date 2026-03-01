@props([
    'slides' => [
        ['title' => 'Kelola Data Pasien', 'subtitle' => 'Akses data pasien dengan aman & cepat'],
        ['title' => 'Monitor Rekam Medis', 'subtitle' => 'Histori lengkap tersimpan & terstruktur'],
        ['title' => 'Laporan Real-Time', 'subtitle' => 'Dashboard analitik terintegrasi'],
    ],
    'stats' => [
        ['value' => '2.4K+', 'label' => 'Pasien'],
        ['value' => '98%', 'label' => 'Uptime'],
        ['value' => '128', 'label' => 'Dokter'],
    ]
])

<div class="carousel">
    {{-- Decorative floating icons --}}
    <x-auth.carousel-icons />

    {{-- Main Medical SVG Illustration --}}
    <x-auth.carousel-illustration />

    {{-- Text slider --}}
    <x-auth.text-slider :slides="$slides" />

    {{-- Stats bar --}}
    <x-auth.stats-bar :stats="$stats" />
</div>
