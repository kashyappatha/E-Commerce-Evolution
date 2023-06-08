@extends('layouts.app')

@section('content')
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

    <table id="categoryTable" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category }}</td>
                    <td>{{ $category->image }}</td>
                    <td>{{ $category->status }}</td>
                    <td>
                        <!-- Add your action buttons HTML here -->
                        <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                        <a href="{{ route('categories.create', $category->id) }}">create</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $category->links() }}

    <script>
        $(document).ready(function() {
            var table = $('#categoryTable').DataTable({
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
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                searching: false, // Disable DataTable's default search feature
            });
        });
    </script>
@endsection
