@extends('layouts.app')
@section('users', 'Edit users')
@section('contents')
    <h1 class="mb-0">Edit User</h1><br />

    <hr />
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $user->id }}">

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">image:</label>
                <input type="file" name="image" class="form-control"
                    accept="image/jpeg, image/png, image/jpg, image/svg" onchange="previewImage(event)">
                @if ($user->image)
                    <img id="preview" src="{{ asset('admin_assets/img/' . $user->image) }}" alt="Image"
                        style="max-width:60px;" accept="image/jpeg, image/png, image/jpg">
                    @if ($user->image)
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
                <label class="form-label">User Name:</label>
                <input type="text" name="name" class="form-control" placeholder="User Name"
                    value="{{ $user->name }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Password"
                    value="{{ $user->password }}">
            </div>

        </div>


        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        </div>
    </form>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
                    // Proceed with the delete action
                    alert('Image deleted!');
                    // Place your delete logic here
                }
            });
        }

        function confirmDeleteProfileImage() {
            Swal.fire({
                title: 'Delete Confirmation',
                text: 'Are you sure you want to delete this profile image?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with the delete action
                    alert('Profile image deleted!');
                    // Place your delete logic here
                }
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

        document.getElementById('yourFormId').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    </script>

    </div>

    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Update</button>
        </div>
        <button class="btn btn-primary">Back</button>

    </div>

    </form>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
