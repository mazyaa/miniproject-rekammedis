@props([
    'value',
    'label',
    'icon' => 'bi-people-fill',
    'variant' => 'primary',
    'trend' => null,
    'trendDirection' => 'up',
    'link' => null,
    'linkText' => 'Lihat Detail'
])

<div class="stat-card {{ $variant }}">
    <div class="stat-icon">
        <i class="bi {{ $icon }}"></i>
    </div>
    <div class="stat-number">{{ $value }}</div>
    <div class="stat-label">{{ $label }}</div>

    @if($trend)
        <div class="stat-trend {{ $trendDirection }}">
            <i class="bi {{ $trendDirection === 'up' ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
            {{ $trend }}
        </div>
    @endif

    @if($link)
        <a href="{{ $link }}" class="stat-link">
            {{ $linkText }}
            <i class="bi bi-arrow-right"></i>
        </a>
    @endif
</div>
