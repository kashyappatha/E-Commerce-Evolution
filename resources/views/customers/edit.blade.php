@extends('layouts.app')
@section('catrgory', 'Edit category')
@section('contents')
    <h1 class="mb-0">Edit Customer</h1><br />

    <hr />
    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $customer->id }}">
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">profile_image:</label>
                <input type="file" name="profile_image" class="form-control"
                    accept="image/jpeg, image/png, image/jpg, image/svg" onchange="previewImage(event)">
                @if ($customer->profile_image)
                    <img id="preview" src="{{ asset('admin_assets/img/' . $customer->profile_image) }}" alt="Image"
                        style="max-width:60px;" accept="image/jpeg, image/png, image/jpg">
                    @if ($customer->profile_image)
                        <div class="mt-2">
                            <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    @endif
                @endif
                <script>
                    function previewImage(event) {
                        var render = new FileReader();
                        render.onload = function() {
                            var output = document.getElementById('preview');
                            output.src = render.result;
                        }
                        render.readAsDataURL(event.target.files[0]);
                    }
                </script>
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
                        axios.delete('{{ route('customers.deleteImage', $customer->id) }}')
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
            <div class="col mb-3">
                <label class="form-label">name:</label>
                <input type="text" name="name" class="form-control" placeholder="" value="{{ $customer->name }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">email:</label>
                <input type="email" name="email" class="form-control" placeholder="Email"
                    value="{{ $customer->email }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">password:</label>
                <input type="password" name="password" class="form-control" placeholder="password"
                    value="{{ $customer->password }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Country:</label>
                <div>
                    <select class="form-select" name="country" value="{{ $customer->country }}"required>
                        <option value="">Select Country</option>
                        <option value="india">India</option>
                        <option value="Australia">Australia</option>

                    </select>
                </div>
            </div>
            <div class="col mb-3">
                <label class="form-label">State:</label>
                <div>
                    <select class="form-select" name="state" value="{{ $customer->state }}"required>
                        <option value="">Select state</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Maharastra">Maharastra</option>
                    </select>
                </div>
            </div>
            <div class="col mb-3">
                <label class="form-label">city:</label>
                <div>
                    <select class="form-select" name="city" value="{{ $customer->city }}" required>
                        <option value="">Select city</option>
                        <option value="Rajkot">Rajkot</option>
                        <option value="Mumbai">Mumbai</option>
                    </select>
                </div>
            </div>
            <div class="col mb-3">
                <label class="form-label">Address_1:</label>
                <input type="text" name="Address_1" class="form-control" placeholder="Enter Your Address_1"
                    value="{{ $customer->Address_1 }}" required>
            </div>
            <div class="col mb-3">
                <label class="form-label">Address_2:</label>
                <input type="text" name="Address_2" class="form-control" placeholder="Enter Your Address_2"
                    value="{{ $customer->Address_2 }}"required>
            </div>
            <div class="col mb-3">
                <label class="form-label">postal_code:</label>
                <input type="number" name="postalcode" class="form-control" placeholder="Enter Your Code"
                    value="{{ $customer->postalcode }}"required>
            </div>
            <div class="col mb-3">
                <label class="form-label">phone:</label>
                <input type="tel" name="phone" class="form-control" placeholder="Enter Your Phone no"
                    value="{{ $customer->phone }}" required>
            </div>






        </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
            <button class="btn btn-primary">Back</button>
            <button class="btn btn-primary">Reset</button>

        </div>

    </form>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@endsection
