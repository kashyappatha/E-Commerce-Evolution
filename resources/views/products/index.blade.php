@extends('layouts.app')
@section('title', 'Home Product')
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Product</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>

    <hr />

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table table-hover" id="kashyap">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Type</th>
                <th>Price</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($product->count() > 0)
                @foreach ($product as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->title }}</td>
                        <td class="allign-middle">{{ $rs->type }}</td>
                        <td class="align-middle">{{ $rs->price }}</td>
                        <td class="align-middle">{{ $rs->product_code }}</td>
                        <td class="align-middle">{{ $rs->description }}</td>
                        <td class="align-middle">
                            <img src="{{ asset('admin_assets/img/' . $rs->image) }}" alt="Image" width="70">
                        </td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('products.show', $rs->id) }}" type="button" class="btn btn-secondary"
                                    onclick="showDetail('{{ route('products.show', $rs->id) }}')">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $rs->id) }}" type="button" class="btn btn-warning"
                                    onclick="showEdit('{{ route('products.edit', $rs->id) }}')">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $rs->id) }}" method="POST"
                                    class="btn btn-danger p-0"
                                    onsubmit="event.preventDefault(); confirmDelete('{{ route('products.destroy', $rs->id) }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0"><i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="8">Product not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Pagination links -->
    {{-- {{ !!$rs->links() !!}} --}}

@endsection

@push('scripts')
    <!-- Add DataTables CSS and JS files -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showDetail(url) {
            Swal.fire({
                title: 'Product Detail',
                text: 'Are you sure you want to see the details?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                timer: 10000000, // Duration in milliseconds (e.g., 3000ms = 3 seconds)
                timerProgressBar: true, // Enable progress bar
                toast: true, // Display as toast
                position: 'top-center'
            }).then((result) => {
                if (result.isConfirmed) {
                    detailproduct(url);
                }
            });
        }

        function showEdit(url) {
            Swal.fire({
                title: 'Edit Product',
                text: 'Are you sure you want to edit this product?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, edit it!',
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
                        title: 'Edited!',
                        text: 'The product has been edited.',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: false,
                        showConfirmButton: true
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while editing the product.',
                        icon: 'error',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: true
                    });
                }
            });
        }

        function confirmDelete(url) {
            Swal.fire({
                title: 'Delete Product',
                text: 'Are you sure you want to delete this product?',
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
                        text: 'The product has been deleted.',
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
                        text: 'An error occurred while deleting the product.',
                        icon: 'error',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }
            });
        }

        $(document).ready(function() {
            var table = $('#kashyap').DataTable({
                processing: true,
                serverSide: true,
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
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'product_code',
                        name: 'product_code'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, full, meta) {
                            return '<img src="' + data + '" alt="Image" width="70">';
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, full, meta) {
                            return '<div class="btn-group" role="group" aria-label="Basic example">' +
                                '<a href="{{ route('products.show', $rs->id) }}" type="button" class="btn btn-secondary"' +
                                'onclick="showDetail(' + "'" +
                                '{{ route('products.show', $rs->id) }}' + "'" + ')">' +
                                '<i class="fas fa-eye"></i>' +
                                '</a>' +
                                '<a href="{{ route('products.edit', $rs->id) }}" type="button" class="btn btn-warning"' +
                                'onclick="showEdit(' + "'" +
                                '{{ route('products.edit', $rs->id) }}' + "'" + ')">' +
                                '<i class="fas fa-edit"></i>' +
                                '</a>' +
                                '<form action="{{ route('products.destroy', $rs->id) }}" method="POST"' +
                                'class="btn btn-danger p-0" ' +
                                'onsubmit="event.preventDefault(); confirmDelete(' + "'" +
                                '{{ route('products.destroy', $rs->id) }}' + "'" + ')">' +
                                '@csrf' +
                                '@method('DELETE')' +
                                '<button class="btn btn-danger m-0">' +
                                '<i class="fa fa-trash" aria-hidden="true"></i>' +
                                '</button>' +
                                '</form>' +
                                '</div>';
                        }
                    }
                ]
            });

            $('form[name="search"]').on('submit', function(e) {
                e.preventDefault();
                table.draw();
            });
        });
    </script>
@endpush
