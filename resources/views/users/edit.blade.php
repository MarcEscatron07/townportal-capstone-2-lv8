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
                        <label for="role_id" class="form-label required">Role:</label>
                        <select id="role_id" name="role_id" class="form-select" required>
                            <option value="" selected>-- --</option>
                            @foreach($roles as $value)
                                <option value="{{$value->id}}" {{ $user && in_array($value->id, [$user->role_id, old('role_id')]) ? 'selected':'' }}>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ $user && $user->username ? $user->username : old('username') }}" required/>
                    </div>
                    <div class="col-lg-4 my-3">
                        <label for="email" class="form-label">Email:</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user && $user->email ? $user->email : old('email') }}"/>
                    </div>
                    <div class="col-lg-4 my-3">
                        <label for="password" class="form-label required">Password:</label>
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required/>
                    </div>
                    <div class="col-lg-4 my-3">
                        <label for="cfpassword" class="form-label required">Confirm Password:</label>
                        <input id="cfpassword" type="password" class="form-control @error('cfpassword') is-invalid @enderror" value="{{ old('cfpassword') }}" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-1">
                        <button type="submit" class="form-submit-btn btn btn-success"><i class="fa fa-share"></i> <span class="ms-2">Send</span></button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection

@push('script')
    <script>
        const originalImage = $('#page-imageviewer').attr('src');

        function displayUploadedFile(input, value, onSuccess, onFail) {
            // console.log('displayUploadedFile > input', input)
            // console.log('displayUploadedFile > value', value)

            if(input && value) {
                const ext = value.substring(value.lastIndexOf('.') + 1).toLowerCase();
                const allowedExt = ['png','jpg','jpeg'];
                if(input.files && input.files[0] && allowedExt.includes(ext)) {
                    /*** File Output ***/
                    const uploadedFile = input.files[0];
                    /*** File Output ***/

                    let reader = new FileReader();
                    reader.onload = function(e){
                        /*** base64 Output ***/
                        const base64image = e.target.result;
                        /*** base64 Output ***/
                        if(onSuccess) {
                            onSuccess(
                                uploadedFile,
                                base64image
                            );
                        }
                    }
                    reader.readAsDataURL(uploadedFile);
                } else {
                    if(onFail) {
                        onFail();
                    }
                }
            } else {
                if(onFail) {
                    onFail();
                }
            }
        }

        function resetFileUpload() {
            $('#page-imageviewer').attr('src', originalImage);
            $("#image-defaultupload").val('');
        }



        $(document).ready(function() {
            $(document).on('change', '.default-fileupload', function(e) {
                // console.log('.default-fileupload > e', e)
                // console.log('.default-fileupload > this', this)

                const input = this;
                const id = input.id;
                const value = $(input).val();
                // console.log(`${id} > value:`, value)

                if(value && value.length > 0) {
                    $(`#${id}`).addClass('text-warning');
                } else {
                    $(`#${id}`).removeClass('text-warning');
                }

                switch(id) {
                    case 'image-defaultupload':
                        displayUploadedFile(
                            input, value,
                            (file, base64image) => {
                                // console.log(`${id} > file:`, file)
                                // console.log(`${id} > base64image:`, base64image)

                                $('#page-imageviewer').attr('src', base64image);
                            },
                            () => { resetFileUpload(); }
                        );
                        break;
                }
            });

            $('#password, #cfpassword').on('keyup', function(e) {
                console.log('#password > val', $('#password').val())
                console.log('#cfpassword > val', $('#cfpassword').val())

                if (
                    $('#password').val().trim() !== '' && $('#cfpassword').val() !== '' &&
                    $('#password').val() == $('#cfpassword').val()
                ) {
                    $('#password, #cfpassword').removeClass('is-invalid was-validated form-control:invalid');
                    $('#password, #cfpassword').addClass('is-valid was-validated form-control:valid');
                    $('.form-submit-btn').removeAttr('disabled');
                } else {
                    $('#password, #cfpassword').removeClass('is-valid was-validated form-control:valid');
                    $('#password, #cfpassword').addClass('is-invalid was-validated form-control:invalid');
                    $('.form-submit-btn').attr('disabled', 'disabled');
                }
            });
        })
    </script>
@endpush
