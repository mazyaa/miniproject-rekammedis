@props([
    'id',
    'name',
    'type' => 'text',
    'label',
    'placeholder' => '',
    'value' => '',
    'icon' => 'email',
    'required' => false,
    'autofocus' => false,
    'autocomplete' => '',
    'errors' => []
])

@php
    $icons = [
        'email' => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>',
        'password' => '<rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
        'user' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
        'phone' => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>'
    ];
    $iconSvg = $icons[$icon] ?? $icons['email'];
@endphp

<div class="input-wrap">
    <label for="{{ $id }}">{{ $label }}</label>
    <div class="input-inner">
        <svg class="input-icon" viewBox="0 0 24 24">{!! $iconSvg !!}</svg>
        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $name }}"
            class="input-field"
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            {{ $required ? 'required' : '' }}
            {{ $autofocus ? 'autofocus' : '' }}
            {{ $autocomplete ? "autocomplete=$autocomplete" : '' }}
        />
    </div>
    @foreach($errors as $msg)
        <div class="field-error">⚠ {{ $msg }}</div>
    @endforeach
</div>
