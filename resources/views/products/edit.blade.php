@extends('layouts.app')
@section('title', 'Edit Product')
@section('contents')
    <h1 class="mb-0">Edit Product</h1>

    <hr />
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Title:</label>
                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $product->title }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Category:</label>
                <select name="type" id="" class="form-control" value="{{ $product->type }}"
                    onchange="showSelectedCategory(this)">
                    <option value="">Select Category Type:</option>
                    <option value="Fruit">Fruit</option>
                    <option value="Grocery">Grocery</option>
                    <option value="Vegetables">Vegetables</option>
                    <option value="Cold-drinks">Cold-drinks</option>
                    <option value="Laptops">Laptops</option>
                    <option value="Mobile Accesories">Mobile accsories</option>
                    <option value="Elctronicas item  ">Electronicas item</option>
                    <option value="T-shirt">Tshirt</option>
                    <option value="Shirt">Shirt</option>
                </select>
            </div>

            <script>
                function showSelectedCategory(selectElement) {
                    var selectedCategory = selectElement.value;
                    var selectedTitle = "{{ $product->title }}";

                    Swal.fire({
                        title: 'Selected Category',
                        text: 'You have chosen ' + selectedCategory + ' for the product with title: ' + selectedTitle,
                        icon: 'info',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }
            </script>
            <div class="col mb-3">
                <label class="form-label">Price:</label>
                <input type="text" name="price" class="form-control" placeholder="Price" value="{{ $product->price }}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Product Code:</label>
                <input type="text" name="product_code" class="form-control" placeholder="Product Code"
                    value="{{ $product->product_code }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Description:</label>

                <textarea class="form-control" name="description" placeholder="Descriptoin">{{ $product->description }}</textarea>

            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Image:</label>
                <input type="file" name="image" class="form-control" placeholder="Enter Image"
                    value="{{ $product->image }}">
            </div>

        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
