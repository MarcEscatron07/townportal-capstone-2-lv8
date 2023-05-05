@extends('layouts.app')

@section('title', 'View Computer')

@section('computers-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">View Computer</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('computers.index') }}" class="btn btn-secondary"><i class="fa fa-backward-step"></i> <span class="ms-2">Back</span></a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content shadow-sm">
    <fieldset class="form-fieldset row">
        <div class="col-12">
            <legend>Computer Information</legend>
        </div>

        <hr class="mb-3" />

        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Network:</span></div>
                <div class="datagrid-content">{{$computer->formattedNetwork()}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Status:</span></div>
                <div class="datagrid-content">{{$computer->formattedStatus()}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Name:</span></div>
                <div class="datagrid-content">{{$computer->name}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Unit:</span></div>
                <div class="datagrid-content">{{$computer->unit}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Remarks:</span></div>
                <div class="datagrid-content">{{$computer->remarks}}</div>
            </div>
        </div>
    </fieldset>
</div>
@endsection
