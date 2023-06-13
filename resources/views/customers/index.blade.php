@extends('layouts.app')

@section('title', 'Home Customers')



@section('style')

    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />


@endsection


@section('contents')

    <div class="d-flex align-items-center justify-content-between">
        <div></div> <!-- Add an empty div to create space on the left side -->
        <a href="{{ route('customers.create') }}" class="btn btn-primary">Add Customer</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="zero_configuration_table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>profile_image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Address_1</th>
                                <th>Address_2</th>
                                <th>postalcode</th>
                                <th>phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <style>
        /* romove order arrow icon */
        table.dataTable thead>tr>th.sorting:before,
        table.dataTable thead>tr>th.sorting_asc:before,
        table.dataTable thead>tr>th.sorting_desc:before,
        table.dataTable thead>tr>th.sorting_asc_disabled:before,
        table.dataTable thead>tr>th.sorting_desc_disabled:before,
        table.dataTable thead>tr>td.sorting:before,
        table.dataTable thead>tr>td.sorting_asc:before,
        table.dataTable thead>tr>td.sorting_desc:before,
        table.dataTable thead>tr>td.sorting_asc_disabled:before,
        table.dataTable thead>tr>td.sorting_desc_disabled:before {
            content: none;
        }

        table.dataTable thead>tr>th.sorting:after,
        table.dataTable thead>tr>th.sorting_asc:after,
        table.dataTable thead>tr>th.sorting_desc:after,
        table.dataTable thead>tr>th.sorting_asc_disabled:after,
        table.dataTable thead>tr>th.sorting_desc_disabled:after,
        table.dataTable thead>tr>td.sorting:after,
        table.dataTable thead>tr>td.sorting_asc:after,
        table.dataTable thead>tr>td.sorting_desc:after,
        table.dataTable thead>tr>td.sorting_asc_disabled:after,
        table.dataTable thead>tr>td.sorting_desc_disabled:after {
            content: none;
        }
    </style>


@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>

    <script>
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $(document).ready(function() {
            dtable = $('#zero_configuration_table').DataTable({
                "language": {
                    "lengthMenu": "_MENU_",
                },
                "columnDefs": [{
                    "targets": "_all",
                    "orderable": false
                }],
                responsive: true,
                'serverSide': true, // Feature control DataTables' server-side processing mode.

                "ajax": {
                    "url": "{{ route('getcustomer') }}",
                    'beforeSend': function(request) {
                        request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr(
                            'content'));
                    },
                    "type": "POST",
                    "data": function(data) {



                    },
                },
            });

            $('.panel-ctrls').append("<i class='separator'></i>");

            $('.panel-footer').append($(".dataTable+.row"));
            $('.dataTables_paginate>ul.pagination').addClass("pull-right");

            $("#apply_filter_btn").click(function() {
                dtable.ajax.reload(null, false);
            });

        });
    </script>
@endsection
