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
    <form id="form-module" class="row p-3" action="{{ route('reports.index', $defModule) }}" method="GET">
        <div class="col-lg-3 my-2">
            <label for="module" class="form-label required">Select Module:</label>
            <select id="module" class="form-select" required>
                @foreach($modules as $value)
                    <option value="{{$value}}" {{ in_array($value, [$defModule, old('module')]) ? 'selected':'' }}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-9 my-2">
            <div class="row h-100 w-100 m-0">
                <div class="col-md-3 d-flex align-items-end p-0">
                    <button id="btn-select" type="submit" class="btn btn-info reports-btn"><i class="fa fa-circle-check"></i> <span class="ms-2">Select</span></button>
                </div>
                <div class="col-md-9 d-flex align-items-end p-0 justify-content-md-end">
                    <button id="btn-clear" type="button" class="btn btn-warning reports-btn" onclick="clearData()" disabled><i class="fa fa-times"></i> <span class="ms-2">Clear</span></button>
                    <button id="btn-generate" type="button" class="btn btn-success reports-btn" onclick="fetchData()"><i class="fa fa-table-list"></i> <span class="ms-2">Generate</span></button>
                </div>
            </div>
        </div>
    </form>

    <form id="form-generate" class="row p-3" action="{{ route('reports.generate', $defModule) }}" method="GET">
        <div class="col-12 mb-2">
            <button id="btn-export" type="submit" class="btn btn-dark reports-btn" disabled><i class="fa fa-download"></i> <span class="ms-2">Export</span></button>
        </div>
        <hr class="my-3" />
        <div class="col-12 table-wrapper">
            <table class="table table-striped shadow" id="table">
                <thead>
                    <tr class="bg-success text-dark">
                        @if($columns && $defModule && $columns[$defModule])
                            @foreach($columns[$defModule] as $key => $value)
                                <th scope="col">{{$value}}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </form>
</div>
@endsection

@push('script')
<script>
    let table;

    $(document).ready(function(){
        $(document).on('change','#module',function(e){
            // console.log('Select module > val', e.target.value)
            const value = e.target.value;
            const reportsForms = ['#form-module', '#form-generate'];
            reportsForms.forEach(rForm => {
                const oldUrl = $(rForm).attr('action');
                // console.log('oldUrl > val', oldUrl)
                const newUrl = oldUrl.substring(0, oldUrl.lastIndexOf('/') + 1).concat(value ?? 'Networks');
                // console.log('newUrl > val', newUrl)
                $(rForm).attr("action", newUrl);
            })

            $("#btn-clear").prop('disabled',true).attr('disabled',true);
            $("#btn-generate").prop('disabled',true).attr('disabled',true);
            $("#btn-export").prop('disabled',true).attr('disabled',true);

            clearData();

            if(value == "{{$defModule}}") {
                $("#btn-generate").prop('disabled',false).attr('disabled',false);
            }
        });

        $('#table').on('preInit.dt length.dt page.dt search.dt order.dt', function() {
            $('.spinner-ctr').css('display', 'flex');
        });

        $('#table').on('init.dt draw.dt', function() {
            $('.spinner-ctr').css('display', 'none');
        });

        $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) {
            console.log(message);
            $('.spinner-ctr').css('display', 'none');
        };

        fetchData(true);
    });

    function clearData() {
        if($.fn.dataTable.isDataTable("#table")){
            table.clear();
            table.destroy();
        }

        // $('#form-generate').trigger('reset');
        $("#btn-clear").prop('disabled',true).attr('disabled',true);
        $("#btn-export").prop('disabled',true).attr('disabled',true);

        let tableObj = {
            scrollY: '340px',
            scrollCollapse: true,
            dom: "<'row mb-2'<'col-md-12 col-lg-4 py-1 d-flex justify-content-lg-start align-items-center'f>" +
                    "<'col-md-12 col-lg-8 py-1 pe-3 d-flex justify-content-lg-end'l>>"
                    + "<'row'<'col-md-12'tr>>" +
                    "<'row mt-2'<'col-md-12 col-lg-4 py-1 d-flex justify-content-lg-start align-items-center'i>" +
                    "<'col-md-12 col-lg-8 py-1 pe-3 d-flex justify-content-lg-end'p>>",
        };

        table = $("#table").DataTable(tableObj);
    }

    function fetchData(isInit) {
        if($.fn.dataTable.isDataTable("#table")){
            table.clear();
            table.destroy();
        }

        const parsedCols = @json($columns && $defModule && $columns[$defModule] ? array_keys($columns[$defModule]) : []);
        const cols = parsedCols.map(pCol => {
            return {
                data: pCol,
                name: pCol,
                width: "auto",
                searchable: true,
                orderable: true
            }
        })
        console.log('Reports table > columns', cols)

        let tableObj = {
            scrollY: '340px',
            scrollCollapse: true,
            dom: "<'row mb-2'<'col-md-12 col-lg-4 py-1 d-flex justify-content-lg-start align-items-center'f>" +
                "<'col-md-12 col-lg-8 py-1 pe-3 d-flex justify-content-lg-end'l>>"
                + "<'row'<'col-md-12'tr>>" +
                "<'row mt-2'<'col-md-12 col-lg-4 py-1 d-flex justify-content-lg-start align-items-center'i>" +
                "<'col-md-12 col-lg-8 py-1 pe-3 d-flex justify-content-lg-end'p>>",
        };

        if(!isInit) {
            $("#btn-clear").prop('disabled',false).attr('disabled',false);
            $("#btn-export").prop('disabled',false).attr('disabled',false);

            tableObj = {
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
                ajax: "{{ route('reports.data', $defModule) }}",
                columns: cols,
            };
        }

        table = $("#table").DataTable(tableObj);
    }
</script>
@endpush
