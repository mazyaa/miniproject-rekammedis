@props([
    'activities' => []
])

<div class="activity-card">
    <div class="activity-header">
        <h3 class="activity-title">Aktivitas Terbaru</h3>
    </div>
    <div class="activity-list">
        @forelse($activities as $activity)
            <div class="activity-item">
                <div class="activity-icon {{ $activity['variant'] ?? 'primary' }}">
                    <i class="bi {{ $activity['icon'] ?? 'bi-activity' }}"></i>
                </div>
                <div class="activity-info">
                    <div class="activity-text">{!! $activity['text'] !!}</div>
                    <div class="activity-time">{{ $activity['time'] }}</div>
                </div>
            </div>
        @empty
            <div class="activity-item">
                <div class="activity-info">
                    <div class="activity-text">Belum ada aktivitas terbaru</div>
                </div>
            </div>
        @endforelse
    </div>
</div>
