@extends('layouts.app')

@section('title', 'View User')

@section('users-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">View User</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="fa fa-backward-step"></i> <span class="ms-2">Back</span></a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content shadow-sm">
    <fieldset class="form-fieldset row">
        <div class="col-12">
            <legend>User Information</legend>
        </div>

        <hr class="mb-3" />

        <div class="col-xl-3">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    @if(file_exists(public_path('images/profile/'.$user->image)))
                        <img id="page-imageviewer" class="image-viewer" src="{{ asset('images/profile/'.$user->image) }}" alt="user-image">
                    @else
                        <img id="page-imageviewer" class="image-viewer" src="{{ asset('images/profile/profile-default.png') }}" alt="user-image">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-9 mt-3">
            <div class="row">
                <div class="col-lg-4 my-3">
                    <div class="datagrid-item">
                        <div class="datagrid-title"><span>Role:</span></div>
                        <div class="datagrid-content">{{$user->formattedRole()}}</div>
                    </div>
                </div>
                <div class="col-lg-4 my-3">
                    <div class="datagrid-item">
                        <div class="datagrid-title"><span>First Name:</span></div>
                        <div class="datagrid-content">{{$user->fname}}</div>
                    </div>
                </div>
                <div class="col-lg-4 my-3">
                    <div class="datagrid-item">
                        <div class="datagrid-title"><span>Middle Name:</span></div>
                        <div class="datagrid-content">{{$user->mname}}</div>
                    </div>
                </div>
                <div class="col-lg-4 my-3">
                    <div class="datagrid-item">
                        <div class="datagrid-title"><span>Last Name:</span></div>
                        <div class="datagrid-content">{{$user->lname}}</div>
                    </div>
                </div>
                <div class="col-lg-4 my-3">
                    <div class="datagrid-item">
                        <div class="datagrid-title"><span>Username:</span></div>
                        <div class="datagrid-content">{{$user->username}}</div>
                    </div>
                </div>
                <div class="col-lg-4 my-3">
                    <div class="datagrid-item">
                        <div class="datagrid-title"><span>Email:</span></div>
                        <div class="datagrid-content">{{$user->email}}</div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
</div>
@endsection
