@extends('layouts.app')

@section('title', 'Products')

@section('products-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6 d-flex align-items-center justify-content-start">
            <h3><span class="header-title">Products</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="{{ route('products.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> <span class="ms-2">New Entry</span></a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container page-content shadow-sm">
    <div class="row">
        <div class="col-12 p-4 table-wrapper">
            <table class="table table-striped shadow" id="table">
                <thead>
                    <tr class="bg-success text-dark">
                        <th scope="col">Category</th>
                        <th scope="col">Name</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Remarks</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    let table;

    $(document).ready(function(){
        $('#table').on('preInit.dt length.dt page.dt search.dt order.dt', function() {
            $('.spinner-ctr').css('display', 'flex');
        });

        $('#table').on('init.dt draw.dt', function() {
            $('.spinner-ctr').css('display', 'none');
        });

        $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
            console.log('DataTable > errMode > message:', message);
            $('.spinner-ctr').css('display', 'none');
        };

        table = $("#table").DataTable({
            "initComplete": function(){
                $('.spinner-ctr').css('display', 'none');
            },
            scrollY: '340px',
            scrollCollapse: true,
            dom: "<'row mb-2'<'col-md-12 col-lg-4 py-1 d-flex justify-content-lg-start align-items-center'f>" +
                 "<'col-md-12 col-lg-8 py-1 pe-3 d-flex justify-content-lg-end'l>>"
                 + "<'row'<'col-md-12'tr>>" +
                 "<'row mt-2'<'col-md-12 col-lg-4 py-1 d-flex justify-content-lg-start align-items-center'i>" +
                 "<'col-md-12 col-lg-8 py-1 pe-3 d-flex justify-content-lg-end'p>>",
            processing: false,
            serverSide: true,
            orderCellsTop: true,
            ajax: "{{ route('products.data') }}",
            columns: [
                {data: 'category_id', name: 'category_id', width:"15%", searchable: true, orderable: true},
                {data: 'name', name: 'name', width:"15%", searchable: true, orderable: true},
                {data: 'stock', name: 'stock', width:"15%", searchable: true, orderable: true},
                {data: 'cost', name: 'cost', width:"15%", searchable: true, orderable: true},
                {data: 'remarks', name: 'remarks', width:"30%", searchable: true, orderable: true},
                {data: 'action', name: 'action', width:"10%", searchable: false, className:"text-center", orderable: false},
            ],
            stateSave: true,
            stateSaveCallback: function(_settings, data) {
                sessionStorage.setItem('table_products', JSON.stringify(data));
            },
            stateLoadCallback: function(_settings) {
                return JSON.parse(sessionStorage.getItem('table_products') ?? '{}');
            }
        });

        $(document).on('click','.btn-delete',function(e){
            e.preventDefault();
            const form = $(this).parents('.btn-group').find('.form-delete');
            if(confirm('Do you really want to delete this data?')){
                sessionStorage.getItem('table_products') ? sessionStorage.removeItem('table_products') : null;
                form.submit();
            }
        });
    });
</script>
@endpush
