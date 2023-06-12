    @extends('layouts.app')

    @section('category', 'Home Category')

    @section('style')

        <link rel="stylesheet" href="{{ asset('css/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/autoFill.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/buttons.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/colReorder.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.dateTime.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/fixedColumns.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/fixedHeader.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/keyTable.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/responsive.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/rowGroup.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/rowReorder.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/scroller.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/searchBuilder.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/searchPanes.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/select.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/datatables/stateRestore.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

    @endsection
    @section('contents')
        <div class="d-flex align-items-center justify-content-between">
            <marquee width="30%" scrollamount="12">
                <h1 class="mb-0 bg-primary text-white text-center">List Category</h1>
            </marquee>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
        </div>

        <hr />

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="col-12 mt-1 mb-3">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                @if (@isset($breadcrumbs))
                    <ol class="breadcrumb">
                        {{-- this will load breadcrumbs dynamically from controller --}}
                        @foreach ($breadcrumbs as $breadcrumb)
                            <li class="breadcrumb-item">
                                @if (isset($breadcrumb['link']))
                                    <a
                                        href="{{ $breadcrumb['link'] == 'javascript:void(0)' ? $breadcrumb['link'] : url($breadcrumb['link']) }}">
                                @endif
                                {{ $breadcrumb['name'] }}
                                @if (isset($breadcrumb['link']))
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @endisset
        </nav>
    </div>

    </div>
    {{-- breadcrumb-end --}}

    <!-- Datatables -->

    @can('category-list')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="zero_configuration_table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @endcan

    {{-- <table class="table table-hover" id="zero_configuration_table">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Status</th> --}}
    {{-- <th>Availibilty</th> --}}
    {{-- <th>Action</th>
                </tr>
            </thead> --}}
    {{-- <tbody>
                @if ($category && $category->count() > 0)
                    @foreach ($category as $rs)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $rs->category }}</td>
                            <td class="align-middle">
                                <img src="{{ asset('admin_assets/img/' . $rs->image) }}" alt="Image" width="70"
                                    accept="image/jpeg, image/png , image/jpg">
                            </td>
                            <td class="align-middle">
                                <label class="form-label">Status:</label>
                                {{ $rs->status }}
                            </td> --}}
    {{-- <td class="align-middle">
                                <label class="form-label">Availibilty:</label>
                                {{ $rs->available }}
                            </td> --}}
    {{-- <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('categories.show', $rs->id) }}" type="button" class="btn btn-info"
                                        onclick="showDetail('{{ route('categories.show', $rs->id) }}')">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $rs->id) }}" type="button"
                                        class="btn btn-warning"
                                        onclick="showEdit('{{ route('categories.edit', $rs->id) }}')">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('categories.destroy', $rs->id) }}" method="POST"
                                        class="btn btn-danger p-0"
                                        onsubmit="event.preventDefault(); confirmDelete('{{ route('categories.destroy', $rs->id) }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-0"><i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </td> --}}
    {{-- @push('scripts')
                                <script>
                                    function showDetail(url) {
                                        Swal.fire({
                                            title: 'Category Detail',
                                            text: 'Are you sure you want to see the  details.',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Are you Want to See!!',
                                            timer: 2000, // Duration in milliseconds (e.g., 3000ms = 3 seconds)
                                            timerProgressBar: true, // Enable progress bar
                                            toast: false, // Display as toast
                                            position: 'top-center'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                detailproduct(url);
                                            }
                                        });
                                    }

                                    function detailProduct(url) {
                                        $.ajax({
                                            url: url,
                                            type: 'POST',
                                            data: {
                                                '_method': 'EDIT',
                                                '_token': '{{ csrf_token() }}'
                                            },
                                            success: function(response) {
                                                Swal.fire({
                                                    title: 'Detailed!',
                                                    text: 'The category has been Viewing.',
                                                    icon: 'success',
                                                    timer: 2000,
                                                    timerProgressBar: true,
                                                    showConfirmButton: false
                                                }).then(() => {
                                                    window.location.reload();
                                                });
                                            },
                                            error: function(xhr, status, error) {
                                                Swal.fire({
                                                    title: 'Error!',
                                                    text: 'An error occurred while Viewing the category.',
                                                    icon: 'error',
                                                    timer: 2000,
                                                    timerProgressBar: true,
                                                    showConfirmButton: false
                                                });
                                            }
                                        });
                                    }


                                    function showEdit(url) {
                                        Swal.fire({
                                            title: 'Edit Category',
                                            text: 'Are you sure you want to Edit this category?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Yes, Edit it!',
                                            cancelButtonText: 'Cancel'
                                        }).then((result) => {
                                            if (result.isConfirmed) {

                                                editProduct(url);
                                            }

                                        });
                                    }

                                    function editProduct(url) {
                                        $.ajax({
                                            url: url,
                                            type: 'POST',
                                            data: {
                                                '_method': 'EDIT',
                                                '_token': '{{ csrf_token() }}'
                                            },
                                            success: function(response) {
                                                Swal.fire({
                                                    title: 'edited!',
                                                    text: 'The category has been edited.',
                                                    icon: 'success',
                                                    timer: 2000,
                                                    timerProgressBar: true,
                                                    showConfirmButton: false
                                                }).then(() => {
                                                    window.location.reload();
                                                });
                                            },
                                            error: function(xhr, status, error) {
                                                Swal.fire({
                                                    title: 'Error!',
                                                    text: 'An error occurred while editing the category.',
                                                    icon: 'error',
                                                    timer: 2000,
                                                    timerProgressBar: true,
                                                    showConfirmButton: false
                                                });
                                            }
                                        });
                                    }

                                    function confirmDelete(url) {
                                        Swal.fire({
                                            title: 'Delete Category',
                                            text: 'Are you sure you want to delete this category?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Yes, delete it!',
                                            cancelButtonText: 'Cancel'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                deleteProduct(url);
                                            }
                                        });
                                    }

                                    function deleteProduct(url) {
                                        $.ajax({
                                            url: url,
                                            type: 'POST',
                                            data: {
                                                '_method': 'DELETE',
                                                '_token': '{{ csrf_token() }}'
                                            },
                                            success: function(response) {
                                                Swal.fire({
                                                    title: 'Deleted!',
                                                    text: 'The category has been deleted.',
                                                    icon: 'success',
                                                    timer: 2000,
                                                    timerProgressBar: true,
                                                    showConfirmButton: false
                                                }).then(() => {
                                                    window.location.reload();
                                                });
                                            },
                                            error: function(xhr, status, error) {
                                                Swal.fire({
                                                    title: 'Error!',
                                                    text: 'An error occurred while deleting the category.',
                                                    icon: 'error',
                                                    timer: 2000,
                                                    timerProgressBar: true,
                                                    showConfirmButton: false
                                                });
                                            }
                                        });
                                    }
                                </script>
                            @endpush

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="5">Category not found</td>
                    </tr>
                @endif
                @stack('scripts')
            </tbody>
        </table> --}}

    {{-- @endsection --}}

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
    @push('scripts')
        <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/autoFill.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/colReorder.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/dataTables.dateTime.min.js') }}"></script>
        <script src="{{ asset('js/datatables/fixedColumns.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/fixedHeader.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('js/datatables/keyTable.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('js/datatables/responsive.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/rowGroup.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/rowReorder.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/scroller.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/searchBuilder.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/searchPanes.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/select.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/stateRestore.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('js/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>


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
                        "url": "{{ route('categories') }}",
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


                $('search').on('submit', function(e) {
                    e.preventDefault();
                    table.draw();
                });

            });
        </script>
    @endpush
