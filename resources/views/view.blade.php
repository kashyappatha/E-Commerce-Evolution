@extends('layouts.app')
@section('name', 'Profile')
@section('contents')
    <h1 class="mb-0">View Profile</h1>
    <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>

    <hr />
    <table class="table">
        <tr>
            <th>Profile_image:</th>
            <td><img src="{{ asset('admin_assets/img/' . auth()->user()->profile_image) }}" alt="Profile_Image"
                    style="max-width: 55px;border-radius:25px;">
            </td>
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
@endsection
