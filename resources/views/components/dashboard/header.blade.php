@props([
    'title' => 'Dashboard',
    'breadcrumbs' => []
])

<div class="dashboard-header">
    <h1>{{ $title }}</h1>
    <div class="breadcrumb-modern">
        <a href="/dashboard">
            <i class="bi bi-house-fill"></i>
        </a>
        @foreach($breadcrumbs as $crumb)
            <span class="separator">/</span>
            @if(isset($crumb['url']))
                <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
            @else
                <span class="current">{{ $crumb['label'] }}</span>
            @endif
        @endforeach
    </div>
</div>
