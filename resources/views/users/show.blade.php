@extends('layouts.app')

@section('title', 'Show User')

@section('contents')
    <div class="card shadow rounded-lg">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Detail Users</h1>
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Roles:</th>
                    <td style="display:inline; padding: 2px 5px; border-radius: 20px; margin-right: 5px; background-color:#008000; color:white;"> <i class="fas fa-check-circle"></i> {{ $user->roles }}</td>
                </tr>
                <tr>
                    <th>User Image:</th>
                    <td><img src="{{ asset('admin_assets/img/' . $user->profile_image) }}" alt="Image"
                            style="max-width: 55px; border-radius: 23px;"></td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Password:</th>
                    <td>{{ $user->password }}</td>
                </tr>
                <tr>
                    <th>created_at:</th>
                    <td>{{ $user->created_at }}</td>
                </tr>
                <tr>
                    <th>updated_at:</th>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
