<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Kashyappathak Register</title>
    <!-- Google Sign-In API -->
    <script src="https://accounts.google.com/gsi/client?client_id=YOUR_GOOGLE_CLIENT_ID"></script>

    <!-- Facebook SDK -->
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=YOUR_FACEBOOK_APP_ID&autoLogAppEvents=1"
        nonce="YOUR_NONCE_VALUE"></script>
    {{-- favicon icon --}}
    <link rel="icon" type="image/x-icon" href="/admin_assets/img/images.png">

    {{-- Add SweatAlert Library --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="{{ route('register.save') }}" method="POST" class="user" id="registerForm">
                                @csrf
                                <div class="form-group">
                                    <input name="name" type="text"
                                        class="form-control form-control-user @error('name')is-invalid @enderror"
                                        id="exampleInputName" placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email"
                                        class="form-control form-control-user @error('email')is-invalid @enderror"
                                        id="exampleInputEmail" placeholder="Email Address">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password" type="password"
                                            class="form-control form-control-user @error('password')is-invalid @enderror"
                                            id="exampleInputPassword" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="password_confirmation" type="password"
                                            class="form-control form-control-user @error('password_confirmation')is-invalid @enderror"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Register
                                    Account</button>
                                <div class="g-signin2" data-onsuccess="onGoogleSignIn"></div>

                                <!-- Facebook login button -->
                                <div class="fb-login-button" data-width="" data-size="large"
                                    data-button-type="continue_with" data-layout="default" data-auto-logout-link="false"
                                    data-use-continue-as="true"></div>


                            </form>
                            <script>
                                // Google Sign-In callback function
                                function onGoogleSignIn(googleUser) {
                                    var id_token = googleUser.getAuthResponse().id_token;
                                    // You can perform additional actions with the ID token, such as sending it to your server for verification
                                    console.log("Google ID token:", id_token);
                                }

                                // Facebook login callback function
                                function statusChangeCallback(response) {
                                    if (response.status === 'connected') {
                                        // Logged into your website and Facebook.
                                        var accessToken = response.authResponse.accessToken;
                                        // You can perform additional actions with the access token, such as sending it to your server for verification
                                        console.log("Facebook access token:", accessToken);
                                    }
                                }
                            </script>

                            <script>
                                // Register form submission
                                document.getElementById('registerForm').addEventListener('submit', function(event) {
                                    event.preventDefault(); // Prevent the default form submission

                                    // Perform form validation
                                    var form = this;
                                    var name = form.elements.name.value;
                                    var email = form.elements.email.value;
                                    var password = form.elements.password.value;
                                    var confirmPassword = form.elements.password_confirmation.value;

                                    // Perform your validation logic here
                                    if (name.trim() === '') {
                                        // Show SweetAlert error message
                                        swal("Error", "Please enter your name", "error");
                                        return;
                                    }

                                    if (email.trim() === '') {
                                        // Show SweetAlert error message
                                        swal("Error", "Please enter your email", "error");
                                        return;
                                    }
                                    if (password.trim() === '') {
                                        // Show SweetAlert error message
                                        swal("Error", "Please enter your password", "error");
                                        return;
                                    }
                                    if (password.length < 8) {
                                        // Show SweetAlert error message
                                        swal("Error", "Password must be at least 8 characters long", "error");
                                        return;
                                    }
                                    if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/u.test(password)) {
                                        // Show SweetAlert error message
                                        swal("Error",
                                            "Password must contain at least one uppercase letter, one lowercase letter, one non-alphanumeric character, and be at least 8 characters long",
                                            "error");
                                        return;
                                    }

                                    if (password !== confirmPassword) {
                                        // Show SweetAlert error message
                                        swal("Error", "Passwords do not match", "error");
                                        return;
                                    }
                                    $.ajax({
                                        url: "{{ route('check.email.unique') }}",
                                        method: "POST",
                                        data: {
                                            email: email
                                        },
                                        success: function(response) {
                                            if (response.exists) {
                                                swal("Error", "Email already exists", "error");
                                            } else {
                                                form.submit();
                                            }

                                        },



                                    });



                                    // Perform other validation checks

                                    // If all validation checks pass, submit the form
                                    form.submit();
                                });
                            </script>
                            <hr>
                            <div class="text-center">
                                <a style="text-decoration: none;" class="small" href="{{ route('login') }}">Already
                                    have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
</body>

</html>
