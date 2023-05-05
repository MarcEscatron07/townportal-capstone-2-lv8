@extends('layouts.app')

@section('title', 'View Product')

@section('products-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">View Product</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="fa fa-backward-step"></i> <span class="ms-2">Back</span></a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content shadow-sm">
    <fieldset class="form-fieldset row">
        <div class="col-12">
            <legend>Product Information</legend>
        </div>

        <hr class="mb-3" />

        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Category:</span></div>
                <div class="datagrid-content">{{$product->formattedCategory()}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Name:</span></div>
                <div class="datagrid-content">{{$product->name}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Stock:</span></div>
                <div class="datagrid-content">{{$product->stock}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Cost:</span></div>
                <div class="datagrid-content">{{$product->cost}}</div>
            </div>
        </div>
        <div class="col-lg-3 my-3">
            <div class="datagrid-item">
                <div class="datagrid-title"><span>Remarks:</span></div>
                <div class="datagrid-content">{{$product->remarks}}</div>
            </div>
        </div>
    </fieldset>
</div>
@endsection
