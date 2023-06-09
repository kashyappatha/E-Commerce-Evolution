@extends('layouts.app')

@section('name', 'Profile')

@section('contents')
    <div class="card shadow rounded-lg">
        <div class="card-header bg-primary text-white">
            <marquee direction="up" scrollamount="4">
            <h1 class="mb-0">View Profile</h1>
            </marquee>
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        </div>
        <div class="card-body">

            <table class="table table-bordered">
                <tr>

                    <th>Roles:</th>
                  <td   style="display: inline-block; padding: 5px 5px;border-radius:10px;font-weight:bold;color:white;margin-top: 10px;margin-left:10px;" class="badge rounded-pill text-success bg-success text-light font-weight-bold; "><i class="fas fa-user">{{ auth()->user()->roles }}</i></td>
                </tr>
                <tr>
                    <th>Profile Image:</th>
                    <td><img src="{{ asset('admin_assets/img/' . auth()->user()->profile_image) }}" alt="Profile Image"
                            style="max-width: 55px; border-radius: 25px;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.7);transition: transform 0.2s;"></td>

<style>
    img:hover {
        transform: scale(1.2);
    }
</style>
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
