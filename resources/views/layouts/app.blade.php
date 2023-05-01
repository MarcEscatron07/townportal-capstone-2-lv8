<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tabler/tabler.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('link')
</head>
<body>
    <div id="app">
        <nav id="appNavbar" class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container px-4">
                <a class="navbar-brand d-inline d-sm-none" href="{{ route('home') }}">
                    <span class="app-logo" title="{{ config('app.name', 'Laravel') }}">
                        <strong class="d-block">{{ config('app.name', 'Laravel') }}</strong>
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            {{-- @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a href="{{ route('home') }}" class="nav-link dropdown-toggle d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open User Menu">
                                    <img class="avatar avatar-sm" src="{{ asset('images/profile-default.png') }}" alt="user-avatar">
                                    <div class="d-none d-sm-block ps-2">
                                        <div class="text-success">{{ \Illuminate\Support\Facades\Auth::user()->username }}</div>
                                        {{-- <div class="mt-1 small text-white">{{ strtoupper(Auth::user()->office) }}</div> --}}
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <a href="{{ route('home') }}" class="dropdown-item">Profile</a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex w-100">Logout</button>
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <aside class="sidenav">
            <div class="sidenav-top">
                <a class="sidenav-brand" href="{{ route('home') }}">
                    <span class="app-logo" title="{{ config('app.name', 'Laravel') }}">
                        <i class="fa fa-scroll me-sm-2"></i>
                        <strong class="d-none d-sm-inline">{{ config('app.name', 'Laravel') }}</strong>
                    </span>
                </a>
            </div>
            <div class="sidenav-mid">
                <!-- Navigation Links -->
                <ul class="navigation-list">
                    <li class="@yield('home-active')" title="Home">
                        <a href="{{ route('home') }}" class="navigation-link row">
                            <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="col-10 d-none d-sm-flex">
                                Home
                            </div>
                        </a>
                    </li>
                    <li class="@yield('networks-active')" title="Networks">
                        <a href="{{ route('networks.index') }}" class="navigation-link row">
                            <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-network-wired"></i>
                            </div>
                            <div class="col-10 d-none d-sm-flex">
                                Networks
                            </div>
                        </a>
                    </li>
                    <li class="@yield('computers-active')" title="Computers">
                        <a href="{{ route('computers.index') }}" class="navigation-link row">
                            <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-computer"></i>
                            </div>
                            <div class="col-10 d-none d-sm-flex">
                                Computers
                            </div>
                        </a>
                    </li>
                    <li class="@yield('peripherals-active')" title="Peripherals">
                        <a href="{{ route('peripherals.index') }}" class="navigation-link row">
                            <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-keyboard"></i>
                            </div>
                            <div class="col-10 d-none d-sm-flex">
                                Peripherals
                            </div>
                        </a>
                    </li>
                    <li class="@yield('products-active')" title="Products">
                        <a href="{{ route('products.index') }}" class="navigation-link row">
                            <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-box"></i>
                            </div>
                            <div class="col-10 d-none d-sm-flex">
                                Products
                            </div>
                        </a>
                    </li>
                    @if(Auth::user()->role_id === 1)
                        <li class="@yield('users-active')" title="Users">
                            <a href="{{ route('users.index') }}" class="navigation-link row">
                                <div class="col-sm-2 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="col-10 d-none d-sm-flex">
                                    Users
                                </div>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="sidenav-bot">
                <span title="Town Portal Asset Management System">T.P.A.M.S. v2.0</span>
            </div>
        </aside>

        <main id="appMain" class="py-4 px-3">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}"></script>
    {{-- <script src="{{ asset('js/tabler/tabler.min.js') }}"></script> --}}
    <script src="{{ asset('js/fontawesome/all.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('script')
</body>
</html>
