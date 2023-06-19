@extends('layouts.app')
@section('title', 'Home Product')
@section('contents')


    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Products</h3>
                    <a href="{{ route('products.create') }}" class="btn btn-primary float-end">Add Products</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Product_code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
<<<<<<< HEAD
                                    <td>
                                        @if ($product->category)
                                            {{ $product->category->category }}
                                        @else
                                            No Category
                                        @endif

                                    </td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->product_code }}</td>

                                    <td>{{ $product->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}"class="btn btn-success"><i
                                                class="fas fa-edit"></a></i>
                                        <a href="{{ route('products.show', $product->id) }}"class="btn btn-info"><i
                                                class="fas fa-eye"></a></i>
                                        <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-danger"><i
                                                class="fas fa-trash-alt"></a></i>
=======
                                    <td>{{ $product->category_id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href=""class="btn btn-success">Edit</a>
                                        <a href=""class="btn btn-success">show</a>
						                <a href="" class="btn btn-danger">Delete</a>
>>>>>>> 9a24babc18bf0406d16fb6e1551253b56b987ee4


                                    </td>





                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7">No Products Available</td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
