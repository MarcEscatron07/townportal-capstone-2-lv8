<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Titillium+Web&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabler/tabler.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('link')
</head>
<body>
    <div id="app">
        <nav id="guestNavbar" class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-center">
                <div class="text-center">
                    <a class="text-decoration-none text-white" href="{{ url('/') }}">
                        <div class="p-2">
                            <i class="fa fa-scroll fa-2x"></i>
                            <h1 class="header-title">Town Portal</h1>
                        </div>
                    </a>
                    <h2 class="subheader-title m-0">Cyber Cafe</h2>
                    <h2 class="subheader-title">Asset Management System</h2>
                </div>
            </div>
        </nav>

        <main id="guestMain" class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/tabler/tabler.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome/all.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('script')
</body>
</html>
