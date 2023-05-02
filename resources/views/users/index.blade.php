@extends('layouts.app')

@section('title', 'Users')

@section('users-active','active')

@section('header')
<div class="container page-header">
    <div class="row">
        <div class="col-6">
            <h3><span class="header-title">Users</span></h3>
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
                        <th scope="col">First Name</th>
                        <th scope="col">Middle Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
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
        // dom: "<'row'<'col-sm-12 col-md-4 py-1'l><'col-sm-12 col-md-4 py-1'<'d-flex justify-content-center'p>><'col-sm-12 col-md-4 py-1'f>>" +
        dom: "<'row'<'col-sm-12 col-md-9 py-1'l><'col-sm-12 col-md-3 py-1'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            // "<'row mt-2'<'col-sm-12 col-md-4 py-1'i><'col-sm-12 col-md-4 py-1'<'d-flex justify-content-center'p>><'col-sm-12 col-md-4 py-1'>>",
            "<'row mt-2'<'col-sm-12 col-md-8 py-1'i><'col-sm-12 col-md-4 py-1 d-flex justify-content-center'p>>",
        processing: false,
        serverSide: true,
        orderCellsTop: true,
        ajax: "{{ route('users.data') }}",
        columns: [
            {data: 'fname', name: 'fname', width:"15%", searchable: true, orderable: true},
            {data: 'mname', name: 'mname', width:"15%", searchable: true, orderable: true},
            {data: 'lname', name: 'lname', width:"15%", searchable: true, orderable: true},
            {data: 'username', name: 'username', width:"15%", searchable: true, orderable: true},
            {data: 'email', name: 'email', width:"30%", searchable: true, orderable: true},
            {data: 'action', name: 'action', width:"10%", searchable: false, className:"text-center", orderable: false},
        ],
        stateSave: true,
        stateSaveCallback: function(_settings, data) {
            sessionStorage.setItem('table_networks', JSON.stringify(data));
        },
        stateLoadCallback: function(_settings) {
            return JSON.parse(sessionStorage.getItem('table_networks') ?? '{}');
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