<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rekam medis app</title>
</head>

<body class="antialiased">
    <h1>Hello dunia tipu tipu</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam laboriosam reiciendis ullam?</p>

    <button class="text-blue-900 bg-sky-500">Coba klik</button>

</body>

<script>
    $(document).ready(function() {
        $("button").click(function() {
            $("p").hide();
        });
    });
</script>

</html>
