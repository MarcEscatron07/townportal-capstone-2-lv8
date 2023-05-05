@extends('layouts.app')

@section('title', 'Edit Product')

@section('products-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">Edit Product</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="fa fa-backward-step"></i> <span class="ms-2">Back</span></a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content page-form shadow-sm">
    <form class="needs-validation" action="{{ route('products.update', $id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PATCH')

        <fieldset class="form-fieldset row">
            <div class="col-12">
                <legend>Product Details</legend>
            </div>

            <hr class="mb-3" />

            <div class="col-lg-3 my-3">
                <label for="category_id" class="form-label required">Category:</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="" selected>-- --</option>
                    @foreach($categories as $value)
                        <option value="{{$value->id}}" {{ $product && in_array($value->id, [$product->category_id, old('category_id')]) ? 'selected':'' }}>{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 my-3">
                <label for="name" class="form-label required">Name:</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $product && $product->name ? $product->name : old('name') }}" required/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="stock" class="form-label">Stock:</label>
                <input id="stock" name="stock" type="number" min="0" step="0.01" class="form-control @error('stock') is-invalid @enderror" value="{{ $product && $product->stock ? $product->stock : old('stock') }}"/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="cost" class="form-label">Cost:</label>
                <input id="cost" name="cost" type="number" min="0" step="0.01" class="form-control @error('cost') is-invalid @enderror" value="{{ $product && $product->cost ? $product->cost : old('cost') }}"/>
            </div>
            <div class="col-lg-3 my-3">
                <label for="remarks" class="form-label">Remarks:</label>
                <textarea id="remarks" name="remarks" class="form-control @error('remarks') is-invalid @enderror">{{ $product && $product->remarks ? $product->remarks : old('remarks') }}</textarea>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-success"><i class="fa fa-share"></i> <span class="ms-2">Send</span></button>
            </div>
        </fieldset>
    </form>
</div>
@endsection
