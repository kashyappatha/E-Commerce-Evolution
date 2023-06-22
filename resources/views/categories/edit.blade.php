@extends('layouts.app')
@section('category', 'Edit category')
@section('contents')
    <marquee width="30%" scrollamount="10">
        <h1 class="mb-0 bg-primary text-white col-md-8">Edit category</h1>
    </marquee>
    <br />

    <div class="mt-4">
        <div class="col-md-4 float-right">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bolder">Additional Information about Category</h5>
                    <hr />
                    <p class="card-text"></p>
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            category
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('categories.show', $category->id) }}">viewpage</a></li>
                            <li><a href="#">Products</a>
                            <li><a href="logout">logout</a></li>
                        </ul>
                    </div>
                    <br />

                    <h2 id="view-profile-heading">View category Page</h2>
                    <div class="card-body" id="view-profile-section" style="display: none;">
                        <div class="card-body">
                            <table class="table table-bordered">

                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $category->category }}</td>
                                </tr>
                                <tr>
                                    <th> Image:</th>
                                    <td><img src="{{ asset('admin_assets/img/' . $category->image) }}" alt="Image"
                                            style="max-width: 55px; border-radius: 10px;"></td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if ($category->status === 'Active')
                                            <span
                                                class="badge rounded-pill text-success bg-success text-light">{{ $category->status }}</span>
                                        @else
                                            <span
                                                class="badge rounded-pill text-danger bg-danger text-light">{{ $category->status }}</span>
                                        @endif
                                    </td>
                                </tr>


                            </table>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $("#view-profile-heading").click(function() {
                                $("#view-profile-section").toggle();
                            });
                        });
                        $(document).ready(function() {
                            $('#update-password-heading').click(function() {
                                $('#password-card').toggle();
                            });
                        });
                    </script>

                </div>
            </div>
        </div>

    </div>

    <hr />
    <form action="{{ route('categories.update', $category->id) }}" method="POST" id="kp">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $category->id }}">
        <table class="table table-bordered col-md-8">
            <tr>
                <td>
                    <label class="form-label">Category:</label>
                    <input type="text" name="category" class="form-control" placeholder="Category"
                        value="{{ $category->category }}">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">Image:</label>
                    <input type="file" name="image" class="form-control"
                        accept="image/jpeg, image/png, image/jpg, image/svg" placeholder="Enter Image">
                    @if ($category->image)
                        <img src="{{ asset('admin_assets/img/' . $category->image) }}" alt="Image"
                            style="max-width:60px;" accept="image/jpeg, image/png, image/jpg">
                        @if ($category->image)
                            <div class="mt-2">
                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">Status:</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="activeStatus" value="Active"
                                {{ $category->status === 'Active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="activeStatus">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inactiveStatus"
                                value="Inactive" {{ $category->status === 'Inactive' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inactiveStatus">Inactive</label>
                        </div>
                    </div>
                    <input type="hidden" name="status_value" id="status-value" value="{{ $category->status }}">
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
            <button class="btn btn-primary">Back</button><br />

        </div>
    </form>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
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
            axios.delete('{{ route('categories.deleteImage', $category->id) }}')
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

            document.getElementById('status-value').value = statusSelected.value;
            return true;
        }

        document.getElementById('kp').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    </script>
@endsection
