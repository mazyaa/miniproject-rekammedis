@php
    $isActive = request()->is(ltrim($route, '/') . '/*') || request()->is(ltrim($route, '/'));
@endphp

@if(!$dropdown)

    {{-- MENU BIASA --}}
    <li class="nav-item">
        <a href="{{ url($route) }}" class="nav-link {{ $isActive ? 'active' : '' }}">
            <i class="{{ $icon }}"></i>
            <p>{{ $menu }}</p>
        </a>
    </li>

@else

    {{-- MENU DROPDOWN --}}
    <li class="nav-item {{ $isActive ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ $isActive ? 'active' : '' }}">
            <i class="{{ $icon }}"></i>
            <p>
                {{ $menu }}
                <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            {{ $slot }}
        </ul>
    </li>

@endif
