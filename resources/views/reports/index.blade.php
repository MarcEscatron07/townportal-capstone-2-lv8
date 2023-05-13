@extends('layouts.app')

@section('title', 'Reports')

@section('reports-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">Generate Report</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content shadow-sm">
    <form class="row p-3" action="{{ route('reports.generate') }}" method="GET">
        <div class="col-lg-3 my-2">
            <label for="module" class="form-label required">Select Module:</label>
            <select id="module" name="module" class="form-select" required>
                <option value="" selected>-- --</option>
                @foreach($modules as $value)
                    <option value="{{$value}}" {{ in_array($value, [$defModule, old('module')]) ? 'selected':'' }}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-9 my-2">
            <div class="row h-100 w-100 m-0">
                <div class="col-3 d-flex align-items-end ps-0">
                    <button type="submit" class="btn btn-info reports-btn"><i class="fa fa-circle-check"></i> <span class="ms-2">Select</span></button>
                </div>
                <div class="col-9 d-flex align-items-end pe-0 justify-content-end">
                    <button type="button" class="btn btn-warning reports-btn me-1"><i class="fa fa-times"></i> <span class="ms-2">Clear</span></button>
                    <button type="button" class="btn btn-success reports-btn ms-1"><i class="fa fa-table-list"></i> <span class="ms-2">Generate</span></button>
                </div>
            </div>
        </div>
    </form>

    <div class="row p-3">
        <div class="col-12 mb-2">
            <button type="submit" class="btn btn-dark reports-btn" disabled><i class="fa fa-download"></i> <span class="ms-2">Export</span></button>
        </div>
        <div class="col-12 table-wrapper">
            <table class="table table-striped shadow" id="table">
                <thead>
                    <tr class="bg-success text-dark">
                        @foreach($columns[$defModule] as $value)
                            <th scope="col">{{$value}}</th>
                        @endforeach
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
</script>
@endpush
