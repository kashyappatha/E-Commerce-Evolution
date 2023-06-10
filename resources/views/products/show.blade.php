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
                    <th>Title:</th>
                    <td>{{ $product->title }}</td>
                </tr>
                <tr>
                    <th>Category:</th>
                    <td>{{ $product->type }}</td>
                </tr>
                <tr>
                    <th>Price:</th>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <th>Product Code:</th>
                    <td>{{ $product->product_code }}</td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th>Product Image:</th>
                    <td><img src="{{ asset('admin_assets/img/' . $product->image) }}" alt="Image"></td>
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
