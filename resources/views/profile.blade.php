@extends('layouts.app')
@section('title', '')
@section('contents')


    @php
        $changeCount = '0';
    @endphp

    <div class="mt-4">
        <div class="col-md-4 float-right">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bolder">Additional Information about Profile</h5>
                    <hr />
                    <p class="card-text"></p>
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="view">viewpage</a></li>
                            <li><a href="{{ route('forget.password.get') }}">Update Password</a></li>
                            <li><a href="">logout</a></li>
                        </ul>
                    </div>
                    <br />

                    <h2 id="view-profile-heading">View Profile Page</h2>
                    <div class="card-body" id="view-profile-section" style="display: none;">
                        <div class="card-body">
                            <table class="table table-bordered" style="margin-left:-60px;">
                                <tr>
                                    <th>Profile Image:</th>
                                    <td><img src="{{ asset('admin_assets/img/' . auth()->user()->profile_image) }}"
                                            alt="Profile Image" style="max-width: 50px; border-radius: 25px;"></td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ auth()->user()->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ auth()->user()->email }}</td>
                                </tr>
                                <tr>
                                    <th>Password:</th>
                                    <td>{{ auth()->user()->password }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>

                    <h2 id="update-password-heading" class="clickable">Update the Password</h2>
                    <div class="card" id="password-card" style="display: none;">
                        <div class="card-header">Reset Password</div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            <form id="editPasswordForm" action="{{ route('profileupdate') }}" method="POST">
                                @csrf

                                <table class="table table-bordered">
                                    <tr>
                                        <td><label>Old password:</label></td>
                                        <td>
                                            <input type="password" name="old_password" id="old_password"
                                                class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>New password:</label></td>
                                        <td>
                                            <input type="password" name="new_password" id="new_password"
                                                class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Confirm new password:</label></td>
                                        <td>
                                            <input type="password" name="confirm_password" id="confirm_password"
                                                class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button class="btn btn-primary">Update</button>
                                            <input type="reset" class="btn btn-primary">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>

                    <script></script>


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



    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('profileupdate') }}">
        @csrf
        @method('post')
        <table class="table table-bordered col-md-8" style="border-collapse: collapse; width: 100%;">
            <tr>
                <th colspan="2" style="background-color: #007bff; color: #fff; padding: 10px; text-align: center;">
                    <marquee width="29%" scrollamount="3.5" direction="down">
                        <h4 class="text-left  text-white  text-center ">Profile Settings</h4>
                    </marquee>
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row" id="res"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="labels">Profile Image:</label>
                </td>
                <td>
                    <input type="file" name="profile_image" class="form-control" placeholder="Enter Image File"
                        value="{{ auth()->user()->profile_image }}" onchange="previewImage(event)">
                    @if ($user->profile_image)
                        <img id="preview" src="{{ asset('/admin_assets/img/' . $user->profile_image) }}" alt="Image"
                            style="max-width: 50px;border-radius:100px" accept="image/jpeg, image/png, image/jpg">
                        <div class="mt-2">
                            <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding: 10px;">
                    <label class="labels">Name:</label>
                </td>
                <td style="padding: 10px;">
                    <input type="text" name="name" class="form-control" placeholder="First Name"
                        value="{{ auth()->user()->name }}"
                        style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
                </td>
            </tr>
            <tr>
                <td style="padding: 10px;">
                    <label class="labels">Email:</label>
                </td>
                <td style="padding: 10px;">
                    <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}"
                        placeholder="Email"
                        style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
                </td>
            </tr>
            <tr>
                <td style="padding: 10px;">
                    <label class="labels">Password:</label>
                </td>
                <td style="padding: 10px;">
                    <input type="password" name="password" class="form-control" placeholder="Password"
                        value="{{ auth()->user()->password }}"
                        style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box;">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button id="btn" class="btn btn-primary profile-button" type="submit"
                        style="background-color: #007bff; color: #fff; border-radius: 4px; padding: 8px 16px; cursor: pointer;">Edit
                        Profile</button>
                    <a href="{{ url()->previous() }}" class="btn btn-info"
                        style="background-color: #17a2b8; color: #fff; border-radius: 4px; padding: 8px 16px; text-decoration: none; cursor: pointer;">Back</a>
                    <button type="reset" class="btn btn-primary"
                        style="background-color: #dc3545; color: #fff; border-radius: 4px; padding: 8px 16px; cursor: pointer;">Reset</button>
                </td>
            </tr>
        </table>


    </form>
    <div class="col-md-4" style="display: flex; justify-content: left;">
        <div class="card"
            style="width: 100%; max-width: 400px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin: 20px;">
            <div class="card-header"
                style="background-color: #007bff; color: #fff; padding: 10px; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                Change Count
            </div>
            <div class="card-body" style="padding: 20px; text-align: center;">
                <h5 class="card-title" id="changeCount" style="font-size: 24px; margin-bottom: 0;">{{ $changeCount }}
                </h5>
            </div>
        </div>
    </div>



    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

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
                            // Delete the image from the server-side
                            deleteImageFromServer('{{ auth()->user()->profile_image }}');
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

        function deleteImageFromServer(imagePath) {
            // Send an AJAX request to delete the image from the server
            axios.delete('{{ asset('admin_assets/img/') }}' + '/' + imagePath)
                .then((response) => {
                    if (response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Image Deleted',
                            text: 'The image has been deleted from the server.',
                        }).then(() => {
                            // Generate avatar using initials
                            var initials = generateInitials('{{ auth()->user()->name }}');
                            var avatarUrl = generateAvatarUrl(initials);

                            // Store the avatar URL in the session
                            axios.post('{{ route('profileupdate.storeAvatar') }}', {
                                avatarUrl: avatarUrl
                            }).then((response) => {
                                if (response.data.success) {
                                    // Reload the page or perform any other necessary action
                                    location.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed',
                                        text: 'Failed to store the avatar in the session.',
                                    });
                                }
                            }).catch((error) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while storing the avatar in the session.',
                                });
                                console.error(error);
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: 'Failed to delete the image from the server.',
                        });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while deleting the image from the server.',
                    });
                    console.error(error);
                });
        }
    </script>

@endsection
