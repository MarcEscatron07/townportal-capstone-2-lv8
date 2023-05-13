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
        <div class="col-lg-3 my-3">
            <label for="module" class="form-label required">Select Module:</label>
            <select id="module" name="module" class="form-select" required>
                <option value="" selected>-- --</option>
                @foreach($modules as $value)
                    <option value="{{$value}}" {{ old('module') == $value ? 'selected':'' }}>{{$value}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-success"><i class="fa fa-table-list"></i> <span class="ms-2">Generate</span></button>
        </div>
    </form>
</div>
@endsection

@push('script')
<script>
</script>
@endpush
