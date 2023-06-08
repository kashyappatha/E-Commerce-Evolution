@extends('layouts.app')
@section('title', 'Show Product')
@section('contents')
    <h1 class="mb-0">Detail Product</h1>

    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $product->title }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Category</label>
            <select name="type" id="" class="form-control" value="{{ $product->type }}" readonly>
                <option value="{{ $product->type }}">Select Category Type:</option>
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
        <div class="col mb-3">
            <label class="form-label">Price</label>
            <input type="text" name="price" class="form-control" placeholder="Price" value="{{ $product->price }}"
                readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">product_code</label>
            <input type="text" name="product_code" class="form-control" placeholder="Product Code"
                value="{{ $product->product_code }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Description</label>

            <textarea class="form-control" name="description" placeholder="Descriptoin" readonly>{{ $product->description }}</textarea>

        </div>
        <div class="col mb-3">
            <label class="form-label">Image:</label>

            <input type="file" class="form-control" name="image" placeholder="Enter The Image"
                onchange="previewImage(event)">
            <img id="imagePreview" src="{{ asset('admin_assets/img/' . $product->image) }}" alt="Image"
                style="max-width:60px;">
        </div>

        <script>
            function previewImage(event) {
                var input = event.target;
                var reader = new FileReader();

                reader.onload = function() {
                    var imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = reader.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        </script>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At"
                value="{{ $product->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At"
                value="{{ $product->updated_at }}" readonly>
        </div>
    </div>
@endsection
