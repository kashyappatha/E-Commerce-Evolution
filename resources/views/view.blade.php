@extends('layouts.app')

@section('name', 'Profile')

@section('contents')
    <div class="card shadow rounded-lg">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">View Profile</h1>
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        </div>
        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th>Profile Image:</th>
                    <td><img src="{{ asset('admin_assets/img/' . auth()->user()->profile_image) }}" alt="Profile Image"
                            style="max-width: 55px; border-radius: 25px;"></td>
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
@endsection
