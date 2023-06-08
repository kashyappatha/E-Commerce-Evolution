@extends('layouts.app')
@section('category', 'Create category')
@section('contents')
    <h1 class="mb-0">Add Category</h1>
    <hr />
    <form action="{{ route('categories.store') }}" method="GET" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Category:</label>
                <input type="text" name="category" class="form-control" placeholder="Enter Your Category" required>
            </div>
            <div class="col">
                <label class="form-label">Image:</label>
                <input type="file" name="image" class="form-control" placeholder="Enter Files Here"
                    accept="jpg/png/jpeg" required>
            </div>
            <div class="col">
                <label class="form-label">Status:</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="activeStatus" value="Active"
                            required>
                        <label class="form-check-label" for="activeStatus">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="inactiveStatus" value="Inactive"
                            required>
                        <label class="form-check-label" for="inactiveStatus">Inactive</label>
                    </div>
                </div>
            </div>
            {{-- <div class="col">
                <label class="form-label">Avalibilty:</label>
                <select name="available" id="available-select" class="form-control" required>
                    <option value="">Select Avalibility Type:</option>
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>

            </div> --}}
            {{-- <script>
                function showSelectedCategory(selectElement) {
                    var selectedCategory = selectElement.value;
                    var selectedTitle = "{{ $category->id }}";

                    Swal.fire({
                        title: 'Selected Category',
                        text: 'You have chosen ' + selectedCategory + ' for the product with title: ' + selectedTitle,
                        icon: 'info',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }
            </script> --}}

        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button class="btn btn-primary">Back</button>


            </div>
        </div>
    </form>
@endsection
