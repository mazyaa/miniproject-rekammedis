@props([
    'title' => 'MediCare Admin',
    'subtitle' => 'Sistem Manajemen Medis'
])

<div class="logo-area">
    <div class="logo-icon">
        <!-- ECG / heartbeat icon -->
        <svg viewBox="0 0 24 24">
            <polyline points="2,12 6,12 8,5 11,19 13,9 15,14 17,12 22,12"/>
        </svg>
    </div>
    <div class="logo-text">
        <strong>{{ $title }}</strong>
        <span>{{ $subtitle }}</span>
    </div>
</div>
