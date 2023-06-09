@extends('layouts.app')
@section('title', 'Profile')
@section('contents')
    <h1 class="mb-0">Profile</h1>

    <hr />

    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('profileupdate') }}">
        @csrf
        @method('post')
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row" id="res"></div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels"> Profile Image:</label>
                            <input type="file" name="profile_image" class="form-control" placeholder="Enter Image File"
                                value="{{ auth()->user()->profile_image }}">
                            @if ($user->profile_image)
                                <img id="preview" src="{{ asset('admin_assets/img/' . $user->profile_image) }}"
                                    alt="Image" style="max-width:60px;" accept="image/jpeg, image/png, image/jpg">
                                <div class="mt-2">
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            @endif
                            <script>
                                function previewImage(event) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var output = document.getElementById('preview');
                                        output.src = reader.result;
                                    }
                                    reader.readAsDataURL(event.target.files[0]);
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
                                    axios.delete('{{ route('profileupdate.deleteImage', $user->id) }}')
                                        .then((response) => {
                                            if (response.data.success) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Image Deleted',
                                                    text: 'The image has been deleted successfully.',
                                                }).then(() => {
                                                    // Reload the page or perform any other necessary action
                                                    location.reload();
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Failed',
                                                    text: 'Failed to delete the image.',
                                                });
                                            }
                                        })
                                        .catch((error) => {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'An error occurred while deleting the image.',
                                            });
                                            console.error(error);
                                        });
                                }
                            </script>
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="First Name"
                                value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}"
                                placeholder="Email">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Password</label>
                            <input type="password" name="password" disabled class="form-control" placeholder="Password"
                                value="{{ auth()->user()->password }}">
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <button id="btn" class="btn btn-primary profile-button" type="submit">Edit Profile</button>
                        <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@endsection
