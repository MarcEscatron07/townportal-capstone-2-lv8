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
    </script>

    @stack('script')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
