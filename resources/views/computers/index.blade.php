@extends('layouts.app')

@section('title', 'Computers')

@section('computers-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6">
            <h3><span class="header-title">Computers</span></h3>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <a href="#" class="btn btn-success"><i class="fa fa-plus"></i> <span class="ms-2">New Entry</span></a>
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
                        {{-- <th scope="col">Network</th>
                        <th scope="col">Status</th> --}}
                        <th scope="col">Name</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Remarks</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let table;

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
        scrollY: '350px',
        scrollCollapse: true,
        dom: "<'row mb-2'<'col-md-12 col-lg-4 py-1 d-flex justify-content-lg-start align-items-center'f>" +
             "<'col-md-12 col-lg-8 py-1 pe-3 d-flex justify-content-lg-end'l>>" 
             + "<'row'<'col-md-12'tr>>" + 
             "<'row mt-2'<'col-md-12 col-lg-4 py-1 d-flex justify-content-lg-start align-items-center'i>" +
             "<'col-md-12 col-lg-8 py-1 pe-3 d-flex justify-content-lg-end'p>>",
        processing: false,
        serverSide: true,
        orderCellsTop: true,
        ajax: "{{ route('computers.data') }}",
        columns: [
            {data: 'name', name: 'name', width:"25%", searchable: true, orderable: true},
            {data: 'unit', name: 'unit', width:"25%", searchable: true, orderable: true},
            {data: 'remarks', name: 'remarks', width:"40%", searchable: true, orderable: true},
            {data: 'action', name: 'action', width:"10%", searchable: false, className:"text-center", orderable: false},
        ],
        stateSave: true,
        stateSaveCallback: function(_settings, data) {
            sessionStorage.setItem('table_computers', JSON.stringify(data));
        },
        stateLoadCallback: function(_settings) {
            return JSON.parse(sessionStorage.getItem('table_computers') ?? '{}');
        }
    });

    $(document).on('click','.btn-delete',function(e){
        e.preventDefault();
        const form = $(this).parents('.btn-group').find('.form-delete');
        if(confirm('Do you really want to delete this data?')){
            form.submit();
        }
    })
</script>
@endsection
