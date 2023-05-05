@extends('layouts.app')

@section('title', 'New Peripheral')

@section('peripherals-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">New Peripheral</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('peripherals.index') }}" class="btn btn-secondary"><i class="fa fa-backward-step"></i> <span class="ms-2">Back</span></a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content page-form shadow-sm">
    <form class="needs-validation" action="{{ route('peripherals.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <fieldset class="form-fieldset row">
            <div class="col-12">
                <legend>Peripheral Details</legend>
            </div>

            <hr class="mb-3" />
            
            <div class="col-lg-3 my-3">
                <label for="computer_id" class="form-label required">Computer:</label>
                <select id="computer_id" name="computer_id" class="form-select" required>
                    <option value="" selected>-- --</option>
                    @foreach($computers as $value)
                        <option value="{{$value->id}}" {{ old('computer_id') == $value->id ? 'selected':'' }}>{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 my-3">
                <label for="type_id" class="form-label required">Type:</label>
                <select id="type_id" name="type_id" class="form-select" required>
                    <option value="" selected>-- --</option>
                    @foreach($types as $value)
                        <option value="{{$value->id}}" {{ old('type_id') == $value->id ? 'selected':'' }}>{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 my-3">
                <label for="name" class="form-label required">Name:</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="brand" class="form-label">Brand:</label>
                <input id="brand" name="brand" type="text" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}"/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="model" class="form-label">Model:</label>
                <input id="model" name="model" type="text" class="form-control @error('model') is-invalid @enderror" value="{{ old('model') }}"/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="serial_number" class="form-label">Serial Number:</label>
                <input id="serial_number" name="serial_number" type="text" class="form-control @error('serial_number') is-invalid @enderror" value="{{ old('serial_number') }}"/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="cost" class="form-label">Cost:</label>
                <input id="cost" name="cost" type="number" min="0" step="0.01" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost') }}"/>
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
