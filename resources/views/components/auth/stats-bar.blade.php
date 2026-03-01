@props([
    'stats' => [
        ['value' => '2.4K+', 'label' => 'Pasien'],
        ['value' => '98%', 'label' => 'Uptime'],
        ['value' => '128', 'label' => 'Dokter'],
    ]
])

<div class="stats-bar">
    @foreach($stats as $stat)
        <div class="stat-item">
            <div class="stat-num">{{ $stat['value'] }}</div>
            <div class="stat-label">{{ $stat['label'] }}</div>
        </div>
    @endforeach
</div>
