@extends('layouts.app')
@section('category', 'Create category')
@section('contents')

    <hr />
    <form action="{{ route('customers.store') }}" method="GET" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered table-center  shadow rounded-lg ">
            <h1 class="mb-0 card-header bg-primary text-white shadow rounded-lg  ">Add Customers</h1>
            <hr />
            <tr>
                <td>
                    <label class="form-label">Profile_image:</label>
                </td>
                <td>
                    <input type="file" name="profile_image" class="form-control" placeholder="Enter Your image"
                        accept="jpg|png|jpeg" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">name:</label>
                </td>
                <td>
                    <input type="text" name="name" class="form-control" placeholder="Enter Your name" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">email:</label>
                </td>
                <td>
                    <input type="email" name="email" class="form-control" placeholder="Enter email Here" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">password:</label>
                </td>
                <td>
                    <input type="password" name="password" class="form-control" placeholder="Enter password Here" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">Country:</label>
                </td>
                <td>
                    <select class="form-select" name="country" id="country" required>
                        <option value="">Select Country</option>
                        <option value="india">India</option>
                        <option value="australia">Australia</option>
                        <option value="srilanka">Srilanka</option>
                        <option value="nepal">Nepal</option>
                        <option value="america">America</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">State:</label>
                </td>
                <td>
                    <select class="form-select" name="state" id="state" required>
                        <option value="">Select State</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">City:</label>
                </td>
                <td>
                    <select class="form-select" name="city" id="city" required>
                        <option value="">Select City</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">Address_1:</label>
                </td>
                <td>
                    <input type="text" name="Address_1" class="form-control" placeholder="Enter Your Address_1" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">Address_2:</label>
                </td>
                <td>
                    <input type="text" name="Address_2" class="form-control" placeholder="Enter Your Address_2" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">postal_code:</label>
                </td>
                <td>
                    <input type="number" name="postalcode" class="form-control" placeholder="Enter Your Code" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">phone:</label>
                </td>
                <td>
                    <input type="tel" name="phone" class="form-control" placeholder="Enter Your Phone no" required>
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button class="btn btn-primary">Back</button>
                <button class="btn btn-primary">Reset</button>
            </div>
        </div>
    </form>

    <script>
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
@endsection
