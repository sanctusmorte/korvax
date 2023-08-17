<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css?ver=1') }}">


    <title>Korvax</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Korvax</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Создать ссылку</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/stats">Статистика</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="app">
    @yield('content')
</div>

<script src="{{ asset('js/app.js') }}?time={{ time() }}"></script>
<script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</body>
</html>
