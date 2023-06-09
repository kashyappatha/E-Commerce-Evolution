@extends('layouts.app')
@section('title', 'Show Product')
@section('contents')
    <h1 class="mb-0">Detail Products</h1>
    <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>

    <hr />
    <table class="table">
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
            <th>Product_code:</th>
            <td>{{ $product->product_code }}</td>
        </tr>
        <tr>
            <th>Description:</th>
            <td>{{ $product->description }}</td>
        </tr>
        <tr>
            <th>Product_image:</th>
            <td><img src="{{ asset('admin_assets/img/' . $product->image) }}" alt="Image"></td>
        </tr>

        <tr>
            <th>created_at:</th>
            <td>{{ $product->created_at }}</td>
        </tr>
        <tr>
            <th>updated_at:</th>
            <td>{{ $product->updated_at }}</td>
        </tr>

    </table>
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
    {{-- <div class="col mb-3">
            <label class="form-label">Availibilty</label>
            <select name="available" id="" class="form-control" value="{{ $category->available }}"
                onchange="showSelectedCategory(this)">
                <option value="">Select Availibilty Type:</option>
                <option value="Available">Available</option>
                <option value="unAvailable">unAvailable</option>
            </select>

        </div>
        <script>
            function showSelectedCategory(selectElement) {
                var selectedCategory = selectElement.value;
                var selectedTitle = "{{ $category->id }}";

                Swal.fire({
                    title: 'Selected Category',
                    text: 'You have chosen ' + selectedCategory + ' for the category with id: ' + selectedTitle,
                    icon: 'info',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        </script>
    </div> --}}

    {{-- <button class="btn btn-primary">Back</button> --}}

@endsection
