@extends('layouts.app')

@section('title', 'Show User')

@section('contents')
    <h1 class="mb-0">Detail Users</h1>
    <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>

    <hr />

    <table class="table">
        <tr>
            <th>User Image:</th>
            <td><img src="{{ asset('admin_assets/img/' . $user->image) }}" alt="Image"
                    style="max-width: 55px;border-radius:25px;"></td>
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
@endsection
