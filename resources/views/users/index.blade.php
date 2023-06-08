@extends('layouts.app')
@section('users', 'Home users')
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List User</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
    </div>

    <hr />
    <form action="{{ route('search') }}" method="GET" id="searchForm"
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="search" name="search" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover" id="users">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>image</th>
                {{-- <th>Availibilty</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($users && $users->count() > 0)
                @foreach ($users as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->name }}</td>
                        <td class="align-middle">{{ $rs->email }}</td>
                        <td class="align-middle">{{ $rs->password }}</td>
                        <td class="align-middle">
                            <img src="" value="{{ $rs->profile_image }}" alt="Image" width="70">
                        </td>
                        {{-- <td class="align-middle">
                            <label class="form-label">Status:</label>
                            {{ $rs->status }}
                        </td> --}}
                        {{-- <td class="align-middle">
                            <label class="form-label">Availibilty:</label>
                            {{ $rs->available }}
                        </td> --}}
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('users.show', $rs->id) }}" type="button" class="btn btn-info"
                                    onclick="showDetail('{{ route('users.show', $rs->id) }}')">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('users.edit', $rs->id) }}" type="button" class="btn btn-warning"
                                    onclick="showEdit('{{ route('users.edit', $rs->id) }}')">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('users.destroy', $rs->id) }}" method="POST"
                                    class="btn btn-danger p-0"
                                    onsubmit="event.preventDefault(); confirmDelete('{{ route('users.destroy', $rs->id) }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0"><i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @push('scripts')
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                function showDetail(url) {
                                    Swal.fire({
                                        title: 'User Detail',
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
                    <td class="text-center" colspan="5">User not found</td>
                </tr>
            @endif
            @stack('scripts')
        </tbody>
    </table>
    <!-- Pagination links -->
    {!! $users->links() !!}
@endsection
@push('scripts')
    <!-- Add DataTables CSS and JS files -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"
        integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#users').DataTable({
                processing: true,
                serverSide: true,
                "deferRender": true,
                "ordering": false,
                ajax: {
                    url: '{{ route('search') }}',
                    data: function(d) {
                        d.search = $('input[name=search]').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'password',
                        name: 'password'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                table.draw();
            });
        });
    </script>
@endpush
