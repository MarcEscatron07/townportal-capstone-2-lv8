@extends('layouts.app')

@section('title', 'My Profile')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">My Profile</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fa fa-backward-step"></i> <span class="ms-2">Back</span></a>
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

            <div class="col-xl-3">
                <div class="page-tabcontainer">
                    <ul id="page-tab" class="page-tab nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button id="fileupload-tab" class="nav-link active" data-bs-target="#fileupload-tab-pane" aria-controls="fileupload-tab-pane" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">
                                File Upload
                            </button>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <button id="webcam-tab" class="nav-link" data-bs-target="#webcam-tab-pane" aria-controls="webcam-tab-pane" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">
                                Webcam
                            </button>
                        </li> --}}
                    </ul>
                    <div id="page-tabcontent" class="page-tabcontent tab-content">
                        <div class="tab-pane fade show active" id="fileupload-tab-pane" role="tabpanel" aria-labelledby="fileupload-tab" tabindex="0">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center justify-content-center">
                                    @if(file_exists(public_path('images/profile/'.$user->image)))
                                        <img id="page-imageviewer" class="image-viewer" src="{{ asset('images/profile/'.$user->image) }}" alt="user-image">
                                    @else
                                        <img id="page-imageviewer" class="image-viewer" src="{{ asset('images/profile/profile-default.png') }}" alt="user-image">
                                    @endif
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="image-customupload" class="form-label">User Image:</label>
                                    <div class="fileupload-container">
                                        <label id="image-customupload" for="image-defaultupload" class="custom-fileupload bg-dark text-white rounded">
                                            <i class="fa fa-upload me-1"></i> Upload Image
                                        </label>
                                        <input id="image-defaultupload" name="image" type="file" class="default-fileupload"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="webcam-tab-pane" role="tabpanel" aria-labelledby="webcam-tab" tabindex="0"> --}}
                            {{-- Webcam HTML here --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-9 mt-3">
                <div class="row">
                    <div class="col-lg-4 my-3">
                        <label for="fname" class="form-label required">First Name:</label>
                        <input id="fname" name="fname" type="text" class="form-control @error('fname') is-invalid @enderror" value="{{ $user && $user->fname ? $user->fname : old('fname') }}" required/>
                    </div>
                    <div class="col-lg-4 my-3">
                        <label for="mname" class="form-label">Middle Name:</label>
                        <input id="mname" name="mname" type="text" class="form-control @error('mname') is-invalid @enderror" value="{{ $user && $user->mname ? $user->mname : old('mname') }}"/>
                    </div>
                    <div class="col-lg-4 my-3">
                        <label for="lname" class="form-label required">Last Name:</label>
                        <input id="lname" name="lname" type="text" class="form-control @error('lname') is-invalid @enderror" value="{{ $user && $user->lname ? $user->lname : old('lname') }}" required/>
                    </div>
                    <div class="col-lg-4 my-3">
                        <label for="username" class="form-label required">Username:</label>
                        <input id="username" name="username" type="text" class="form-control credentials @error('username') is-invalid @enderror" value="{{ $user && $user->username ? $user->username : old('username') }}" required disabled/>
                    </div>
                    <div class="col-lg-4 my-3">
                        <label for="email" class="form-label">Email:</label>
                        <input id="email" name="email" type="email" class="form-control credentials @error('email') is-invalid @enderror" value="{{ $user && $user->email ? $user->email : old('email') }}" disabled/>
                    </div>
                    <div class="col-lg-4 my-3">
                        <label for="password" class="form-label required">Password:</label>
                        <input id="password" name="password" type="password" class="form-control credentials @error('password') is-invalid @enderror" value="{{ old('password') }}" required disabled/>
                    </div>
                    <div class="col-lg-4 my-3">
                        <label for="cfpassword" class="form-label required">Confirm Password:</label>
                        <input id="cfpassword" type="password" class="form-control credentials @error('cfpassword') is-invalid @enderror" value="{{ old('cfpassword') }}" required disabled/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-1">
                        <button type="submit" class="form-submit-btn btn btn-success"><i class="fa fa-share"></i> <span class="ms-2">Send</span></button>
                        <div class="form-check ms-md-4">
                            <input id="update-credentials" type="checkbox" class="form-check-input" />
                            <label class="form-check-label" for="update-credentials">
                                Update Credentials
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $("#update-credentials").click(function(e) {
            if($(this).is(":checked")){
                $(".credentials").attr('disabled',false).prop('disabled',false);
            }else{
                $(".credentials").attr('disabled',true).prop('disabled',true);
            }
        })
    });
</script>
@endpush
