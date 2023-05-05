@extends('layouts.app')

@section('title', 'Edit User')

@section('users-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">Edit User</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fa fa-backward-step"></i> <span class="ms-2">Back</span></a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content page-form shadow-sm">
    <form class="needs-validation" action="{{ route('users.update', $id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PATCH')

        <fieldset class="form-fieldset row">
            <div class="col-12">
                <legend>User Details</legend>
            </div>

            <hr class="mb-3" />

            <div class="col-lg-3 my-3">
                <label for="role_id" class="form-label required">Role:</label>
                <select id="role_id" name="role_id" class="form-select" required>
                    <option value="" selected>-- --</option>
                    @foreach($roles as $value)
                        <option value="{{$value->id}}" {{ $user && in_array($value->id, [$user->role_id, old('role_id')]) ? 'selected':'' }}>{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 my-3">
                <label for="fname" class="form-label required">First Name:</label>
                <input id="fname" name="fname" type="text" class="form-control @error('fname') is-invalid @enderror" value="{{ $user && $user->fname ? $user->fname : old('fname') }}" required/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="mname" class="form-label">Middle Name:</label>
                <input id="mname" name="mname" type="text" class="form-control @error('mname') is-invalid @enderror" value="{{ $user && $user->mname ? $user->mname : old('mname') }}"/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="lname" class="form-label required">Last Name:</label>
                <input id="lname" name="lname" type="text" class="form-control @error('lname') is-invalid @enderror" value="{{ $user && $user->lname ? $user->lname : old('lname') }}" required/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="username" class="form-label required">Username:</label>
                <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ $user && $user->username ? $user->username : old('username') }}" required/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="email" class="form-label required">Email:</label>
                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user && $user->email ? $user->email : old('email') }}" required/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="password" class="form-label required">Password:</label>
                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ $user && $user->password ? $user->password : old('password') }}" required/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="cfpassword" class="form-label required">Confirm Password:</label>
                <input id="cfpassword" name="cfpassword" type="password" class="form-control @error('cfpassword') is-invalid @enderror" value="{{ old('cfpassword') }}" required/>
            </div>

            <div class="col-lg-3 my-3">
                <label for="image" class="form-label">User Image:</label>
                <input id="image" name="image" type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}"/>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-success"><i class="fa fa-share"></i> <span class="ms-2">Send</span></button>
            </div>
        </fieldset>
    </form>
</div>
@endsection
