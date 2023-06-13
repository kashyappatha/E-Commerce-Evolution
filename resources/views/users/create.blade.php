@extends('layouts.app')
@section('user', 'Create user')
@section('contents')
    <marquee width="30%" scrollamount="7" direction="up">
        <h1 class="mb-0 bg-primary text-white col-md-6">Add User</h1>
    </marquee>
    <hr />

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="table-responsive shadow">
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <label class="form-label">Profile Image:</label>
                                <input type="file" name="profile_image" class="form-control"
                                    placeholder="Select Profile Image" accept="image/jpeg, image/png, image/jpg, image/svg">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-label">Name:</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Your Name"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email Here"
                                    required>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </div>
    </form>
@endsection
