@props([
    'cardTitle' => 'Grafik',
    'cardTitleHighlight' => 'Perkembangan',
    'chartId' => 'mainChart'
])

<div class="chart-card">
    <div class="chart-header">
        <h3 class="chart-title">{{ $cardTitle }} <em>{{ $cardTitleHighlight }}</em></h3>
    </div>
    <canvas id="{{ $chartId }}"></canvas>
    {{ $slot }}
</div>
