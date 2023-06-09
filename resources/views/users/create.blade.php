@extends('layouts.app')
@section('user', 'Create user')
@section('contents')
    <h1 class="mb-0">Add User</h1>
    <hr />
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Profile Image:</label>
                <input type="file" name="profile_image" class="form-control" placeholder="Select Profile Image"
                    accept="image/jpeg, image/png, image/jpg, image/svg">

            </div>
            <div class="col">
                <label class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
            </div>
            <div class="col">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email Here" required>
            </div>
            <div class="col">
                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password Here" required>
            </div>

        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
@endsection
