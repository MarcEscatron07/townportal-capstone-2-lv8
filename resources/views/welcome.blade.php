@extends('layouts.guest')

@section('title', 'Welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="content">
                <div class="accounts-container">
                    <div class="px-2 mx-2 px-sm-5 mx-sm-5">
                        <h1 class="mb-3 text-center">&lt; Accounts &gt;</h1>
                        <hr>
                        <h2>Owner</h2>
                        <ul class="list-unstyled">
                            <li>Username: <strong>marcusbenz07</strong></li>
                            <li>Password: <strong>passowner</strong></li>
                        </ul>

                        <h2>Manager</h2>
                        <ul class="list-unstyled">
                            <li>Username: <strong>espegez28</strong></li>
                            <li>Password: <strong>passmanager</strong></li>
                        </ul>

                        <h2>Staff</h2>
                        <ul class="list-unstyled">
                            <li>Username: <strong>kewnie25</strong></li>
                            <li>Password: <strong>passstaff</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <ul class="nav nav-pills d-flex flex-row text-center bg-dark" id="pills-tab" role="tablist">
                <li class="nav-item w-50">
                    <a class="nav-link rounded-0 active" id="pills-login-tab" data-bs-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Log In</a>
                </li>
                <li class="nav-item w-50">
                    <a class="nav-link rounded-0" id="pills-register-tab" data-bs-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                    <div class="card py-4">
                        {{-- <div class="card-header rounded-0 bg-light text-dark">{{ __('Login') }}</div> --}}

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                            {{-- <form method="POST" action=""> --}}
                                @csrf

                                <div class="form-group row my-2">
                                    <label for="login_username" class="col-md-4 col-form-label text-md-right">{{ __('Username:') }}</label>

                                    <div class="col-md-6">
                                        <input id="login_username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="login_password" class="col-md-4 col-form-label text-md-right">{{ __('Password:') }}</label>

                                    <div class="col-md-6">
                                        <input id="login_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="form-group row my-2">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="form-group row my-2 mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-yellow rounded-0">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                    <div class="card">
                        {{-- <div class="card-header bg-light text-dark">{{ __('Register') }}</div> --}}

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                            {{-- <form method="POST" action=""> --}}
                                @csrf

                                <div class="form-group row my-2">
                                    <label for="register_firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname:') }}</label>

                                    <div class="col-md-6">
                                        <input id="register_firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="register_middlename" class="col-md-4 col-form-label text-md-right">{{ __('Middlename:') }}</label>

                                    <div class="col-md-6">
                                        <input id="register_middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}" required autocomplete="middlename" autofocus>

                                        @error('middlename')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="register_lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname:') }}</label>

                                    <div class="col-md-6">
                                        <input id="register_lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="register_username" class="col-md-4 col-form-label text-md-right">{{ __('Username:') }}</label>

                                    <div class="col-md-6">
                                        <input id="register_username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="register_email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address:') }}</label>

                                    <div class="col-md-6">
                                        <input id="register_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="register_password" class="col-md-4 col-form-label text-md-right">{{ __('Password:') }}</label>

                                    <div class="col-md-6">
                                        <input id="register_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row my-2">
                                    <label for="register_cfmpassword" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password:') }}</label>

                                    <div class="col-md-6">
                                        <input id="register_cfmpassword" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row my-2 mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-yellow rounded-0">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
