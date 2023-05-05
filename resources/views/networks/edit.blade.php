@extends('layouts.app')

@section('title', 'Edit Network')

@section('networks-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">Edit Network</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('networks.index') }}" class="btn btn-secondary"><i class="fa fa-backward-step"></i> <span class="ms-2">Back</span></a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content page-form shadow-sm">
    <form class="needs-validation" action="{{ route('networks.update', $id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PATCH')

        <fieldset class="form-fieldset row">
            <div class="col-12">
                <legend>Network Details</legend>
            </div>

            <hr class="mb-3" />

            <div class="col-lg-4 my-3">
                <label for="name" class="form-label required">Name:</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $network && $network->name ? $network->name : old('name') }}" required/>
            </div>
            <div class="col-lg-4 my-3">
                <label for="provider" class="form-label required">Provider:</label>
                <select id="provider" name="provider" class="form-select" required>
                    <option value="" selected>-- --</option>
                    @foreach($providers as $key => $value)
                        <option value="{{$key}}" {{ $network && in_array($key, [$network->provider, old('provider')]) ? 'selected':'' }}>{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 my-3">
                <label for="cost" class="form-label">Cost:</label>
                <input id="cost" name="cost" type="number" min="0" step="0.01" class="form-control @error('cost') is-invalid @enderror" value="{{ $network && $network->cost ? $network->cost : old('cost') }}"/>
            </div>
            <div class="col-lg-4 my-3">
                <label for="remarks" class="form-label">Remarks:</label>
                <textarea id="remarks" name="remarks" class="form-control @error('remarks') is-invalid @enderror">{{ $network && $network->remarks ? $network->remarks : old('remarks') }}</textarea>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-success"><i class="fa fa-share"></i> <span class="ms-2">Send</span></button>
            </div>
        </fieldset>
    </form>
</div>
@endsection
