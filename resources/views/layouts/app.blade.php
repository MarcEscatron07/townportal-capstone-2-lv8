<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
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
    <link href="{{ asset('plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/Toastr/toastr.min.css') }}" rel="stylesheet">

    @stack('link')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!-- Spinner/Loader -->
        <div class="spinner-ctr">
            <div class="spinner-wpr">
                <div class="spinner-grow mx-1 text-blue" role="status"></div>
                <div class="spinner-grow mx-1 text-indigo" role="status"></div>
                <div class="spinner-grow mx-1 text-purple" role="status"></div>
                <div class="spinner-grow mx-1 text-pink" role="status"></div>
                <div class="spinner-grow mx-1 text-red" role="status"></div>
                <div class="spinner-grow mx-1 text-orange" role="status"></div>
                <div class="spinner-grow mx-1 text-yellow" role="status"></div>
                <div class="spinner-grow mx-1 text-lime" role="status"></div>
                <div class="spinner-grow mx-1 text-green" role="status"></div>
                <div class="spinner-grow mx-1 text-teal" role="status"></div>
                <div class="spinner-grow mx-1 text-cyan" role="status"></div>
            </div>
        </div>

        <nav id="appNavbar" class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container px-4">
                <a class="navbar-brand d-inline d-sm-none" href="{{ route('home') }}">
                    <span class="app-logo" title="{{ config('app.name', 'Laravel') }}">
                        <strong class="d-block">{{ config('app.name', 'Laravel') }}</strong>
                    </span>
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse mt-3 mt-md-0" id="navbarSupportedContent">
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
                                    @if(Auth::user()->image && file_exists(public_path('images/profile/'.Auth::user()->image)))
                                        <img class="avatar avatar-sm" src="{{ asset('images/profile/'.Auth::user()->image) }}" alt="auth-user-avatar">
                                    @else
                                        <img class="avatar avatar-sm" src="{{ asset('images/profile/profile-default.png') }}" alt="user-avatar">
                                    @endif
                                    <div class="ps-2">
                                        <div class="text-success">{{ \Illuminate\Support\Facades\Auth::user()->username }}</div>
                                        <div class="mt-1 small">{{ Auth::user()->formattedRole() }}</div>
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
                <span title="Town Portal Asset Management System v2.0">T.P.A.M.S. v2.0</span>
            </div>
        </aside>

        <main id="appMain" class="p-4">
            <section>
                @yield('header')
            </section>
            <section>
                @yield('content')
            </section>
        </main>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}"></script>
    {{-- <script src="{{ asset('js/tabler/tabler.min.js') }}"></script> --}}
    <script src="{{ asset('js/fontawesome/all.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/Toastr/toastr.min.js') }}"></script>

    <script>
        @if( \Illuminate\Support\Facades\Session::has('success') )
            toastr.success('', "{!! session('success') !!}");
        @elseif( \Illuminate\Support\Facades\Session::has('failed') )
            toastr.error('', "{!! session('failed') !!}");
        @endif

        @if( \Illuminate\Support\Facades\Session::has('confirm') )
            if(confirm("{!! session('confirm') !!}")) {
                @if( \Illuminate\Support\Facades\Session::has('confirm_yes') )
                    {!! session('confirm_yes') !!}
                @endif
            } else {
                @if( \Illuminate\Support\Facades\Session::has('confirm_no') )
                    {!! session('confirm_no') !!}
                @endif
            }
        @endif

        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

    @stack('script')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
