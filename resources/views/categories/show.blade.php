@extends('layouts.app')
@section('title', 'Show Product')
@section('contents')
    <h1 class="mb-0">Detail category</h1>
    <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>

    <hr />
    <table class="table">
        <tr>
            <th>Category:</th>
            <td>{{ $category->category }}</td>
        </tr>
        <tr>
            <th>Image:</th>
            <td><img src="{{ asset('admin_assets/img/' . $category->image) }}" alt="Image"
                    style="max-width: 70px;border-radius:19px;"></td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{ $category->status }}</td>
        </tr>
        <tr>
            <th>created_at:</th>
            <td>{{ $category->created_at }}</td>
        </tr>
        <tr>
            <th>updated_at:</th>
            <td>{{ $category->updated_at }}</td>
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
