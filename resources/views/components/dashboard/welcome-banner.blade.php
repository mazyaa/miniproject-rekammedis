@props([
    'bannerTitle' => 'Kami Melayani & Menangani',
    'bannerHighlight' => 'Dengan Sepenuh Hati',
    'subtitle' => 'Memberikan pelayanan kesehatan terbaik untuk masyarakat.',
    'image' => 'img/medical-care-rafiki.svg'
])

<div class="welcome-banner">
    <div class="welcome-content">
        <div class="welcome-text">
            <h2>{{ $bannerTitle }} <em>{{ $bannerHighlight }}</em></h2>
            <p>{{ $subtitle }}</p>
            {{ $slot }}
        </div>
        <div class="welcome-illustration">
            <img src="{{ asset('assets/' . $image) }}" alt="Ilustrasi Medical">
        </div>
    </div>
</div>
