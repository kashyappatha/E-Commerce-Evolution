@extends('layouts.app')
@section('category', 'Create category')
@section('contents')
    <h1 class="mb-0">Add Customers</h1>
    <hr />
    <form action="{{ route('customers.store') }}" method="GET" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">

            <div class="col">
                <label class="form-label">Profile_image:</label>
                <input type="file" name="profile_image" class="form-control" placeholder="Enter Your image"
                    accept="jpg|png|jpeg" required>
            </div>
            <div class="col">
                <label class="form-label">name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Your name" required>
            </div>
            <div class="col">
                <label class="form-label">email:</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email Here" required>
            </div>
            <div class="col">
                <label class="form-label">password:</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password Here" required>
            </div>
            <div class="col">
                <label class="form-label">Country:</label>
                <div>
                    <select class="form-select" name="country" id="country" required>
                        <option value="">Select Country</option>
                        <option value="india">India</option>
                        <option value="australia">Australia</option>
                        <option value="sri  lanka">Srilanka</option>
                        <option value="nepal">Nepal</option>
                        <option value="america">America</option>

                    </select>
                </div>
            </div>

            <div class="col">
                <label class="form-label">State:</label>
                <div>
                    <select class="form-select" name="state" id="state" required>
                        <option value="">Select State</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <label class="form-label">City:</label>
                <div>
                    <select class="form-select" name="city" id="city" required>
                        <option value="">Select City</option>
                    </select>
                </div>
            </div>

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

            <div class="col">
                <label class="form-label">Address_1:</label>
                <input type="text" name="Address_1" class="form-control" placeholder="Enter Your Address_1" required>
            </div>
            <div class="col">
                <label class="form-label">Address_2:</label>
                <input type="text" name="Address_2" class="form-control" placeholder="Enter Your Address_2" required>
            </div>
            <div class="col">
                <label class="form-label">postal_code:</label>
                <input type="number" name="postalcode" class="form-control" placeholder="Enter Your Code" required>
            </div>
            <div class="col">
                <label class="form-label">phone:</label>
                <input type="tel" name="phone" class="form-control" placeholder="Enter Your Phone no" required>
            </div>

        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button class="btn btn-primary">Back</button>
                <button class="btn btn-primary">Reset</button>

            </div>
        </div>
    </form>
@endsection
