{{--
    Login Page - MediCare Admin
    Refactored into clean, reusable Blade components

    Components used:
    - x-auth.logo           : Logo branding
    - x-auth.login-form     : Complete login form
    - x-auth.login-carousel : Right side carousel with illustration
    - x-auth.input-field    : Reusable form input with icon
    - x-auth.text-slider    : Animated text slider
    - x-auth.stats-bar      : Statistics bar
--}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - MediCare Admin</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-wrapper">
        <div class="box">
            <div class="inner-box">
                {{-- Form Side --}}
                <x-auth.login-form />

                {{-- Carousel Side --}}
                <x-auth.login-carousel />
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login-slider.js') }}"></script>
</body>
</html>
