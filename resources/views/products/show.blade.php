@extends('layouts.app')

@section('title', 'Show Product')

@section('contents')
    <div class="card shadow rounded-lg">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Detail Products</h1>
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        </div>
        <div class="card-body">
            <hr />
            <table class="table table-bordered">
                <tr>
                    <th>Product_thumbnail:</th>
                    <td>
                        <img src="{{ asset('admin_assets/img/' . $product->images) }}" alt="Image"
                            style="max-width: 130px; border-radius: 10px;">
                    </td>
                </tr>
                <tr>
                    <th>Category:</th>
                    <td>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Product_name:</th>
                    <td>{{ $product->title }}</td>
                </tr>
                {{-- <tr>
                    <th>Image:</th>
                    <td>
                        @foreach ($product->productImages as $image)
                            <img src="{{ asset('admin_assets/img/' . $product->image) }}" alt="Image"
                                class="me-4 border" />
                        @endforeach
                    </td>

                </tr> --}}

                <tr>
                    <th>Brands:</th>
                    <td>{{ $product->brand }}</td>
                </tr>

                <tr>
                    <th>small_description:</th>
                    <td>{{ $product->small_description }}</td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th>orignal_price:</th>
                    <td>{{ $product->orignal_price }}</td>
                </tr>
                <tr>
                    <th>selling_price:</th>
                    <td>{{ $product->selling_price }}</td>
                </tr>
                <tr>
                    <th>Quantity:</th>
                    <td>{{ $product->quantity }}</td>
                </tr>

                <tr>
                    <th>Product Code:</th>
                    <td>{{ $product->product_code }}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>
                        @if ($product->status == '1')
                            <span class="badge rounded-pill text-success bg-success text-light">
                                <i class="fas fa-check-circle me-1"></i>Active
                            </span>
                        @else
                            <span class="badge rounded-pill text-danger bg-danger text-light">
                                <i class="fas fa-times-circle me-1"></i>Inactive
                            </span>
                        @endif
                    </td>
                </tr>





                <tr>
                    <th>Created At:</th>
                    <td>{{ $product->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At:</th>
                    <td>{{ $product->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        function validateForm() {
            var statusRadios = document.getElementsByName('status');
            var statusSelected = false;

            for (var i = 0; i < statusRadios.length; i++) {
                if (statusRadios[i].checked) {
                    statusSelected = true;
                    break;
                }
            }

            if (!statusSelected) {
                Swal.fire({
                    title: 'Error',
                    text: 'Please select a status',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                return false;
            }

            return true;
        }

        document.getElementById('yourFormId').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    </script>
@endsection
