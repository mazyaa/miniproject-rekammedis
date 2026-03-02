<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Puskesmas SukaHati | {{ $code }} - {{ $title }}</title>
    <meta name="description" content="{{ $description }}" />

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet" crossorigin="anonymous" />

    {{-- Shared head (fonts, icons, Three.js, GSAP, etc.) --}}
    <x-head :title="$code . ' - ' . $title" />

    {{-- Error page styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/error-page.css') }}" />

    @if(isset($customCss))
    <style>{!! $customCss !!}</style>
    @endif
</head>

<body class="error-page {{ $variant ?? '' }}">

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
            <div class="error-code" id="errorCode" data-code="{{ $code }}">{{ $code }}</div>

            {{-- Separator --}}
            <div class="separator" id="separator"></div>

            {{-- Subtitle (typed) --}}
            <h1 class="error-subtitle" id="subtitle">
                <span id="typed-text"></span><span class="typed-cursor">|</span>
            </h1>

            {{-- Description --}}
            <p class="error-description" id="description">
                {{ $description }}
            </p>

            {{-- Info Cards --}}
            <div class="info-cards" id="infoCards">
                @foreach($cards as $card)
                <div class="info-card">
                    <div class="icon-wrapper"><i class="bi {{ $card['icon'] }}"></i></div>
                    <h6>{{ $card['title'] }}</h6>
                    <p>{{ $card['text'] }}</p>
                </div>
                @endforeach
            </div>

            {{-- Action Buttons --}}
            <div class="btn-group-custom" id="btnGroup">
                @if(isset($primaryAction))
                <a href="{{ $primaryAction['url'] }}" class="btn-glow btn-primary-glow">
                    <i class="bi {{ $primaryAction['icon'] }}"></i> {{ $primaryAction['text'] }}
                </a>
                @else
                <a href="{{ url('/dashboard') }}" class="btn-glow btn-primary-glow">
                    <i class="bi bi-house-door"></i> Kembali ke Beranda
                </a>
                @endif

                <button onclick="history.back()" class="btn-glow btn-outline-glow">
                    <i class="bi bi-arrow-left"></i> Halaman Sebelumnya
                </button>
            </div>

            {{-- Diagnostic --}}
            <div class="diagnostic-info" id="diagnostic">
                <div class="badge-custom">
                    <span class="dot {{ $statusDot ?? '' }}"></span>
                    {{ $statusText ?? 'Server Online — Sistem Berjalan Normal' }}
                </div>
                <div class="diagnostic-details">
                    <span>STATUS: {{ $code }}</span>
                    <span>|</span>
                    <span>PATH: {{ request()->path() }}</span>
                    <span>|</span>
                    <span>TIME: <span id="currentTime"></span></span>
                </div>
            </div>

        </div>
    </div>

    {{-- Scripts --}}
    <script>
        // Error title for typed animation
        window.errorTitle = "{{ $title }}";
    </script>
    <script src="{{ asset('assets/js/error-particles.js') }}"></script>
    <script src="{{ asset('assets/js/error-animations.js') }}"></script>
</body>

</html>
