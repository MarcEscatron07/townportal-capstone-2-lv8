@extends('layouts.app')

@section('title', 'View Peripheral')

@section('computers-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">View Peripheral</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('peripherals.index') }}" class="btn btn-secondary"><i class="fa fa-backward-step"></i> <span class="ms-2">Back</span></a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content shadow-sm">
    <fieldset class="form-fieldset row">
        <div class="col-12">
            <legend>Peripheral Information</legend>
        </div>

        <hr class="mb-3" />

        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Computer:</span></div>
                <div class="datagrid-content">{{$peripheral->formattedComputer()}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Type:</span></div>
                <div class="datagrid-content">{{$peripheral->formattedType()}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Name:</span></div>
                <div class="datagrid-content">{{$peripheral->name}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Brand:</span></div>
                <div class="datagrid-content">{{$peripheral->brand}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Model:</span></div>
                <div class="datagrid-content">{{$peripheral->model}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Serial Number:</span></div>
                <div class="datagrid-content">{{$peripheral->serial_number}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Cost:</span></div>
                <div class="datagrid-content">{{$peripheral->cost}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Remarks:</span></div>
                <div class="datagrid-content">{{$peripheral->remarks}}</div>
            </div>
        </div>
    </fieldset>
</div>
@endsection
