@extends('layouts.app')

@section('title', 'New Computer')

@section('computers-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">New Computer</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('computers.index') }}" class="btn btn-secondary"><i class="fa fa-backward-step"></i> <span class="ms-2">Back</span></a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content page-form shadow-sm">
    <form class="needs-validation" action="{{ route('computers.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <fieldset class="form-fieldset row">
            <div class="col-12">
                <legend>Computer Details</legend>
            </div>

            <hr class="mb-3" />
            
            <div class="col-lg-3 my-3">
                <label for="network_id" class="form-label required">Network:</label>
                <select id="network_id" name="network_id" class="form-select" required>
                    <option value="" selected>-- --</option>
                    @foreach($networks as $value)
                        <option value="{{$value->id}}" {{ old('network_id') == $value->id ? 'selected':'' }}>{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 my-3">
                <label for="status_id" class="form-label required">Status:</label>
                <select id="status_id" name="status_id" class="form-select" required>
                    <option value="" selected>-- --</option>
                    @foreach($statuses as $value)
                        <option value="{{$value->id}}" {{ old('status_id') == $value->id ? 'selected':'' }}>{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 my-3">
                <label for="name" class="form-label required">Name:</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="unit" class="form-label required">Unit:</label>
                <select id="unit" name="unit" class="form-select" required>
                    <option value="" selected>-- --</option>
                    @foreach($units as $key => $value)
                        <option value="{{$key}}" {{ old('unit') == $key ? 'selected':'' }}>{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 my-3">
                <label for="remarks" class="form-label">Remarks:</label>
                <textarea id="remarks" name="remarks" class="form-control @error('remarks') is-invalid @enderror"></textarea>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-success"><i class="fa fa-share"></i> <span class="ms-2">Send</span></button>
            </div>
        </fieldset>
    </form>
</div>
@endsection
