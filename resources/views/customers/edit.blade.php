@extends('layouts.app')
@section('category', 'Edit category')
@section('contents')

    <marquee width="30%" scrollamount="13">
        <h1 class="mb-0 bg-primary text-white text-center">Edit Customer</h1><br />
    </marquee>


    <div class="mt-4">
        <div class="col-md-4 float-right">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-bolder">Additional Information about Customers</h5>
                    <hr />
                    <p class="card-text"></p>
                    <div class="dropdown">
                        <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            customers
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('customers.show', $customer->id) }}">viewpage</a></li>
                            <li><a href="#">Orders</a>
                            <li><a href="logout">logout</a></li>
                        </ul>
                    </div>
                    <br />

                    <h2 id="view-profile-heading">View Customers Page</h2>
                    <div class="card-body" id="view-profile-section" style="display: none;">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Profile Image:</th>
                                    <td><img src="{{ asset('admin_assets/img/' . $customer->profile_image) }}"
                                            alt="Profile Image" style="max-width: 55px; border-radius: 25px;"></td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $customer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <th>country:</th>
                                    <td>{{ $customer->country }}</td>
                                </tr>
                                <tr>
                                    <th>State:</th>
                                    <td>{{ $customer->state }}</td>
                                </tr>
                                <tr>
                                    <th>city:</th>
                                    <td>{{ $customer->city }}</td>
                                </tr>
                                <tr>
                                    <th>Address_1:</th>
                                    <td>{{ $customer->Address_1 }}</td>
                                </tr>
                                <tr>
                                    <th>Address_2:</th>
                                    <td>{{ $customer->Address_2 }}</td>
                                </tr>
                                <tr>
                                    <th>Postalcode:</th>
                                    <td>{{ $customer->postalcode }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $customer->phone }}</td>
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
    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $customer->id }}">
        <table class="table table-bordered col-md-8">
            <tr>
                <td>
                    <label class="form-label">profile_image:</label>
                </td>
                <td>
                    <input type="file" name="profile_image" class="form-control"
                        accept="image/jpeg, image/png, image/jpg, image/svg" onchange="previewImage(event)">
                    @if ($customer->profile_image)
                        <img id="preview" src="{{ asset('admin_assets/img/' . $customer->profile_image) }}"
                            alt="Image" style="max-width:60px;" accept="image/jpeg, image/png, image/jpg">
                        @if ($customer->profile_image)
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
                    <label class="form-label">name:</label>
                </td>
                <td>
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ $customer->name }}">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">email:</label>
                </td>
                <td>
                    <input type="email" name="email" class="form-control" placeholder="Email"
                        value="{{ $customer->email }}">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">password:</label>
                </td>
                <td>
                    <input type="password" name="password" class="form-control" placeholder="password"
                        value="{{ $customer->password }}">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">Country:</label>
                </td>
                <td>
                    <div>
                        <select class="form-select" name="country" id="country" onchange="toggleState(this)" required>
                            <option value="">Select Country</option>
                            <option value="india">India</option>
                            <option value="australia">Australia</option>
                            <option value="srilanka">Srilanka</option>
                            <option value="nepal">Nepal</option>
                            <option value="america">America</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr id="stateContainer" style="display: none;">
                <td>
                    <label class="form-label">State:</label>
                </td>
                <td>
                    <div>
                        <select class="form-select" name="state" id="state" required>
                            <option value="">Select state</option>
                            <!-- Add your state options here -->
                        </select>
                    </div>
                </td>
            </tr>
            <tr id="cityContainer" style="display: none;">
                <td>
                    <label class="form-label">city:</label>
                </td>
                <td>
                    <div>
                        <select class="form-select" name="city" id="city" required>
                            <option value="">Select city</option>
                            <!-- Add your city options here -->
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">Address_1:</label>
                </td>
                <td>
                    <input type="text" name="Address_1" class="form-control" placeholder="Enter Your Address_1"
                        value="{{ $customer->Address_1 }}" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">Address_2:</label>
                </td>
                <td>
                    <input type="text" name="Address_2" class="form-control" placeholder="Enter Your Address_2"
                        value="{{ $customer->Address_2 }}" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">postal_code:</label>
                </td>
                <td>
                    <input type="number" name="postalcode" class="form-control" placeholder="Enter Your Code"
                        value="{{ $customer->postalcode }}" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">phone:</label>
                </td>
                <td>
                    <input type="tel" name="phone" class="form-control" placeholder="Enter Your Phone no"
                        value="{{ $customer->phone }}" required>
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
            <button class="btn btn-primary">Back</button>
            <button class="btn btn-primary">Reset</button>
        </div>
        </div>
    </form>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        function previewImage(event) {
            var render = new FileReader();
            render.onload = function() {
                var output = document.getElementById('preview');
                output.src = render.result;
            }
            render.readAsDataURL(event.target.files[0]);
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

        function toggleState(countrySelect) {
            var stateContainer = document.getElementById('stateContainer');
            var cityContainer = document.getElementById('cityContainer');

            if (countrySelect.value !== '') {
                stateContainer.style.display = 'block';
                cityContainer.style.display = 'block';
            } else {
                stateContainer.style.display = 'none';
                cityContainer.style.display = 'none';
            }
        }

        const countrySelect = document.getElementById('country');
        const stateSelect = document.getElementById('state');
        const citySelect = document.getElementById('city');

        // Define the data for states and cities
        const data = {
            india: {
                gujarat: ['Rajkot', 'Ahmedabad', 'surat', 'Morbi', 'Junagadh', 'Surendranagar', 'Vadodra',
                    'Gandhinagar', 'Kutch', 'Gir Somnath', 'Dwarka'
                ],
                maharashtra: ['Mumbai', 'Pune', 'thane', 'Nashik', 'Amravati'],
                rajasthan: ['Jaipur', 'Ajmer', 'Udaipur', 'kota', 'Nagpur', 'Jodhpur'],
                delhi: ['New Delhi', 'Old Delhi', 'North Delhi', 'South Delhi', 'East Delhi', 'West Delhi'],
                utterpradesh: ['Agra']
            },
            australia: {
                victoria: ['Melbourne', 'Geelong'],
                nsw: ['Sydney', 'Newcastle']
            },
            'srilanka': {
                batticaloa: ['panomapattu', 'Erroverpattu'],
                colombo: ['sinhalese']
            }
        };

        // Function to populate the options for states based on the selected country
        function populateStates() {
            const selectedCountry = countrySelect.value;
            stateSelect.innerHTML = '<option value="">Select State</option>';
            citySelect.innerHTML = '<option value="">Select City</option>';

            if (selectedCountry && data[selectedCountry]) {
                const states = Object.keys(data[selectedCountry]);
                for (const state of states) {
                    const option = document.createElement('option');
                    option.value = state;
                    option.textContent = state.charAt(0).toUpperCase() + state.slice(1);
                    stateSelect.appendChild(option);
                }
            }
        }

        // Function to populate the options for cities based on the selected state
        function populateCities() {
            const selectedCountry = countrySelect.value;
            const selectedState = stateSelect.value;
            citySelect.innerHTML = '<option value="">Select City</option>';

            if (selectedCountry && selectedState && data[selectedCountry] && data[selectedCountry][selectedState]) {
                const cities = data[selectedCountry][selectedState];
                for (const city of cities) {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city.charAt(0).toUpperCase() + city.slice(1);
                    citySelect.appendChild(option);
                }
            }
        }

        // Event listeners for country and state select elements
        countrySelect.addEventListener('change', populateStates);
        stateSelect.addEventListener('change', populateCities);
    </script>
    </div>
@endsection
