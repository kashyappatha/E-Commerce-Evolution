@extends('layouts.app')
@section('title', 'Profile')
@section('contents')

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
                            <li><a href="{{ 'forget.get' }}">Update Password</a></li>
                            <li><a href="">logout</a></li>
                        </ul>
                    </div>
                    <br />

                    <h2 id="view-profile-heading">View Profile Page</h2>
                    <div class="card-body" id="view-profile-section" style="display: none;">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Profile Image:</th>
                                    <td><img src="{{ asset('admin_assets/img/' . auth()->user()->profile_image) }}"
                                            alt="Profile Image" style="max-width: 55px; border-radius: 25px;"></td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ auth()->user()->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ auth()->user()->email }}</td>
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

                            <form action="{{ route('forget.password.post') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail
                                        Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email"
                                            required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Send Reset Link</button>
                                </div>
                                <br />
                                <div class="col-md-6 offset-md-4">
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                </div>
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
        <table class="table table-bordered col-md-8">
            <tr>
                <th colspan="2">
                    <marquee width="29%" scrollamount="10">
                        <h4 class="text-left bg-primary text-white  text-center ">Profile Settings</h4>
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
                        <img id="preview" src="{{ asset('admin_assets/img/' . $user->profile_image) }}" alt="Image"
                            style="max-width: 60px;" accept="image/jpeg, image/png, image/jpg">
                        <div class="mt-2">
                            <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <label class="labels">Name:</label>
                </td>
                <td>
                    <input type="text" name="name" class="form-control" placeholder="First Name"
                        value="{{ auth()->user()->name }}">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="labels">Email:</label>
                </td>
                <td>
                    <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}"
                        placeholder="Email">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="labels">Password:</label>
                </td>
                <td>
                    <input type="password" name="password" disabled class="form-control" placeholder="Password"
                        value="{{ auth()->user()->password }}">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button id="btn" class="btn btn-primary profile-button" type="submit">Edit Profile</button>
                    <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
                    <button type="reset" class="btn btn-primary">Reset</button>
                </td>
            </tr>
        </table>

    </form>


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

@endsection
