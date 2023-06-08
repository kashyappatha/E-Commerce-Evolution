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
            <div class="col mb-3">
                <label class="form-label">Profile Image:</label>
                <input type="file" name="profile_image" class="form-control"
                    accept="image/jpeg, image/png, image/jpg, image/svg" placeholder="Select Profile Image">
                @if ($user->profile_image)
                    <img src="{{ asset('admin_assets/img/' . $user->profile_image) }}" alt="Profile Image"
                        style="max-width:60px;" accept="image/jpeg, image/png, image/jpg">
                    <div class="mt-2">
                        <label class="form-check-label">
                            <button type="submit" name="profile_image" value="Delete" class="form-check-input"
                                onclick="confirmDeleteProfileImage()"><i class="fas fa-trash">Delete</i></button>
                        </label>
                    </div>
                @endif
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
