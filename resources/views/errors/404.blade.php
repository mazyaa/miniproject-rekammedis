<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Puskesmas SukaHati | 404 - Halaman Tidak Ditemukan</title>
    <meta name="description" content="Halaman yang Anda cari tidak ditemukan." />

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet" crossorigin="anonymous" />

    {{-- Shared head (fonts, icons, Three.js, GSAP, etc.) --}}
    <x-head :title="'404 - Halaman Tidak Ditemukan'" />

    {{-- Error page styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/error-page.css') }}" />
</head>

<body class="error-page">

    {{-- Loader --}}
    <div class="loader-screen" id="loader">
        <div class="loader-ring"></div>
    </div>

    {{-- Three.js Canvas --}}
    <canvas id="bg-canvas"></canvas>

    {{-- Overlays --}}
    <div class="gradient-overlay"></div>
    <div class="scanline"></div>

    {{-- Main Content --}}
    <div class="content-wrapper">
        <div class="error-container">

            {{-- Error Code --}}
            <div class="error-code" id="errorCode" data-code="404">404</div>

            {{-- Separator --}}
            <div class="separator" id="separator"></div>

            {{-- Subtitle (typed) --}}
            <h1 class="error-subtitle" id="subtitle">
                <span id="typed-text"></span><span class="typed-cursor">|</span>
            </h1>

            {{-- Description --}}
            <p class="error-description" id="description">
                Maaf, halaman yang Anda cari tidak dapat ditemukan. Halaman mungkin telah
                dipindahkan, dihapus, atau URL yang Anda masukkan salah. Silakan periksa
                kembali alamat URL atau gunakan navigasi di bawah ini.
            </p>

            {{-- Info Cards --}}
            <div class="info-cards" id="infoCards">
                <div class="info-card">
                    <div class="icon-wrapper"><i class="bi bi-link-45deg"></i></div>
                    <h6>Periksa URL</h6>
                    <p>Pastikan alamat URL yang diketik sudah benar dan tidak ada kesalahan penulisan.</p>
                </div>
                <div class="info-card">
                    <div class="icon-wrapper"><i class="bi bi-arrow-counterclockwise"></i></div>
                    <h6>Halaman Dipindahkan</h6>
                    <p>Konten mungkin telah dipindahkan ke lokasi baru dalam sistem kami.</p>
                </div>
                <div class="info-card">
                    <div class="icon-wrapper"><i class="bi bi-headset"></i></div>
                    <h6>Butuh Bantuan?</h6>
                    <p>Hubungi administrator sistem jika masalah ini terus berlanjut.</p>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="btn-group-custom" id="btnGroup">
                <a href="{{ url('/dashboard') }}" class="btn-glow btn-primary-glow">
                    <i class="bi bi-house-door"></i> Kembali ke Beranda
                </a>
                <button onclick="history.back()" class="btn-glow btn-outline-glow">
                    <i class="bi bi-arrow-left"></i> Halaman Sebelumnya
                </button>
            </div>

            {{-- Diagnostic --}}
            <div class="diagnostic-info" id="diagnostic">
                <div class="badge-custom">
                    <span class="dot"></span>
                    Server Online — Sistem Berjalan Normal
                </div>
                <div class="diagnostic-details">
                    <span>STATUS: 404</span>
                    <span>|</span>
                    <span>PATH: {{ request()->path() }}</span>
                    <span>|</span>
                    <span>TIME: <span id="currentTime"></span></span>
                </div>
            </div>

        </div>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('assets/js/error-particles.js') }}"></script>
    <script src="{{ asset('assets/js/error-animations.js') }}"></script>
</body>

</html>
