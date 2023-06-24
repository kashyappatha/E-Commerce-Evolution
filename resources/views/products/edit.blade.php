@extends('layouts.app')
@section('title', 'Edit Product')
@section('contents')

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h4 class="alert alert-success">{{ session('message') }}</h4>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3> edit Products</h3>
                    <a href="{{ url('admin/products') }}" class="btn btn-primary float-end">Back</a>
                </div>
                <div class="card-body">


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif



                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">
                                    Home
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                    aria-controls="details-tab-pane" aria-selected="false">
                                    Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">
                                    Product Image
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="mb-3">
                                    <label>category:</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Image:</label>
                                        <input type="file" name="images" class="form-control"
                                            accept="image/jpeg, image/png, image/jpg, image/svg"
                                            value="{{ $product->images }}" placeholder="Enter Image">
                                        @if ($product->images)
                                            <img src="{{ asset($product->images) }}" alt="Image"
                                                style="max-width: 100px; border-radius:50px;">
                                            @if ($product->images)
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Product Name:</label>
                                    <input type="text" name="title" value="{{ $product->title }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Brand</label>
                                    <input type="text" name="brand" value="{{ $product->brand }}"class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Small_description:</label>
                                    <textarea name="small_description" class="form-control" rows="4">{{ $product->small_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Description:</label>
                                    <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Orignal_price:</label>
                                            <input type="text" name="orignal_price"
                                                value="{{ $product->orignal_price }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Selling_price:</label>
                                            <input type="text" name="selling_price"
                                                value="{{ $product->selling_price }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Quantity:</label>
                                            <input type="number" name="quantity" value="{{ $product->quantity }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Product_code:</label>
                                            <input type="text" name="product_code"
                                                value="{{ $product->product_code }}"class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Status:</label><br>
                                            <input type="checkbox"
                                                name="status"{{ $product->status == '1' ? 'checked' : '' }}>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                aria-labelledby="image-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>Upload Product image:</label>
                                    <input type="file" name="image[]" multiple class="form-control" />

                                </div>

                                <div>
                                    @if ($product->productImages)
                                        <div class="row">
                                            @foreach ($product->productImages as $image)
                                                <div class="col-md-32">
                                                    <img src="{{ asset($image->image) }}" alt="Image"
                                                        style="width:80px;height:80px;" class="me-4 border" />


                                                    <a href="{{ route('images.destroy', $image->id) }}"
                                                        class="d-block">Remove</a>


                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <h5>No Image Added</h5>
                                    @endif
                                </div>


                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

                    <script>
                        function confirmDelete() {
                            Swal.fire({
                                title: 'Delete Confirmation',
                                text: 'Are you sure you want to delete this image?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Delete the image from the server
                                    deleteImage();
                                }
                            });
                        }

                        function deleteImage() {
                            // Send an AJAX request to delete the image
                            axios.delete('{{ route('products.deleteImage', $product->id) }}')
                                .then((response) => {
                                    if (response.data.success) {
                                        alert('Image deleted!');
                                        // Reload the page or perform any other necessary action
                                    } else {
                                        alert('Failed to delete image!');
                                    }
                                })
                                .catch((error) => {
                                    alert('An error occurred while deleting the image!');
                                    console.error(error);
                                });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
