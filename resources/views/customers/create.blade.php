@extends('layouts.app')

@section('category', 'Create category')

@section('contents')
    <hr />
    <form action="{{ route('customers.store') }}" method="GET" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered table-center  shadow rounded-lg">
            <h1 class="mb-0 card-header bg-primary text-white shadow rounded-lg">Add Customers</h1>
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
                    <select name="country" class="form-control" id="country">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    // Fetch states based on the selected country
                    $('#country').on('change', function() {
                        var idCountry = this.value;
                        $("#state").html('');
                        $.ajax({
                            url: "{{ route('getStatesByCountry') }}",
                            type: "POST",
                            data: {
                                cid: idCountry,
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(result) {
                                $('#state').html('<option value="">-- Select State --</option>');
                                $.each(result.states, function(key, value) {
                                    $("#state").append('<option value="' + value.id + '">' +
                                        value.name + '</option>');
                                });
                                $('#city').html('<option value="">-- Select City --</option>');
                            }
                        });
                    });

                    // Fetch cities based on the selected state
                    $('#state').change(function() {
                        var stateId = $(this).val();
                        if (stateId) {
                            $.ajax({
                                url: '{{ route('cities.getCitiesByState') }}',
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    state_id: stateId
                                },
                                success: function(data) {
                                    $('#city').html('<option value="">-- Select City --</option>');
                                    $.each(data.cities, function(key, value) {
                                        $('#city').append('<option value="' + value.id + '">' +
                                            value.name +
                                            '</option>');
                                    });
                                }
                            });
                        } else {
                            $('#city').html('<option value="">-- Select City --</option>');
                        }
                    });
                });
            </script>
            <tr>
                <td>
                    <label class="form-label">State:</label>
                    <select name="state" class="form-control" id="state">
                        <option value="">-- Select State --</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label">City:</label>
                    <select name="city" class="form-control" id="city">
                        <option value="">-- Select City --</option>
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
                <button type="submit" class="btn btn-primary" style="width: 80px;">Submit</button>
                <button class="btn btn-primary" style="width: 80px;">Back</button>
                <button type="reset" class="btn btn-primary" style="width: 80px;">Reset</button>
            </div>
        </div>
    </form>

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
    </script>
@endsection
