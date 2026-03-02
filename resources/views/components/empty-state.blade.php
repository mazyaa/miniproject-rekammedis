@props([
    'id' => null,
    'icon' => 'bi-inbox',
    'variant' => 'primary',
    'title' => 'Data Tidak Ditemukan',
    'message' => 'Belum ada data yang tersedia.',
    'actionText' => null,
    'actionTarget' => null,
    'actionId' => null,
    'actionStyle' => 'filled',
    'hidden' => false,
])

@php
    $variantMap = [
        'primary' => '',
        'search'  => 'search',
        'warning' => 'search',
    ];
    $iconVariant = $variantMap[$variant] ?? '';
    $btnClass = $actionStyle === 'outline' ? 'btn-outline-primary' : 'btn-primary btn-lg';
@endphp

<div @if($id) id="{{ $id }}" @endif
    class="empty-state-container"
    @if($hidden) style="display: none;" @endif>
    <div class="empty-state-card">
        <div class="empty-state-icon {{ $iconVariant }}">
            <i class="bi {{ $icon }}"></i>
        </div>

        <h4 class="empty-state-title">{{ $title }}</h4>

        <p class="empty-state-text">{!! $message !!}</p>

        @if($actionText)
            <button class="btn {{ $btnClass }} empty-state-btn"
                @if($actionTarget) data-bs-toggle="modal" data-bs-target="{{ $actionTarget }}" @endif
                @if($actionId) id="{{ $actionId }}" @endif>
                {{ $actionText }}
            </button>
        @endif
    </div>
</div>
