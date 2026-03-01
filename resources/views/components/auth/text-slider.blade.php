@props([
    'tag' => 'Sistem Kesehatan Digital',
    'slides' => [
        ['title' => 'Kelola Data Pasien', 'subtitle' => 'Akses data pasien dengan aman & cepat'],
        ['title' => 'Monitor Rekam Medis', 'subtitle' => 'Histori lengkap tersimpan & terstruktur'],
        ['title' => 'Laporan Real-Time', 'subtitle' => 'Dashboard analitik terintegrasi'],
    ]
])

<div class="text-slider">
    <div class="slide-tag">{{ $tag }}</div>

    <div class="text-wrap">
        <div class="text-group" id="textGroup">
            @foreach($slides as $slide)
                <h2>{{ $slide['title'] }}</h2>
            @endforeach
        </div>
    </div>

    <div class="text-sub-wrap">
        <div class="text-sub-group" id="subGroup">
            @foreach($slides as $slide)
                <p>{{ $slide['subtitle'] }}</p>
            @endforeach
        </div>
    </div>

    <div class="bullets" id="bullets">
        @foreach($slides as $index => $slide)
            <span class="{{ $index === 0 ? 'active' : '' }}" data-value="{{ $index }}"></span>
        @endforeach
    </div>
</div>
