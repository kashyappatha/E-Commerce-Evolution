@extends('layouts.app')

@section('title', 'Show Customer')

@section('contents')
    <div class="card shadow rounded-lg ">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Detail Customers</h1>
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        </div>
        <div class="card-body ">


            <table class="table table-bordered">
                <tr>
                    <th>Customer Image:</th>
                    <td><img src="{{ asset('admin_assets/img/' . $customer->profile_image) }}" alt="Profile Image"
                            style="max-width: 55px; border-radius: 25px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.7);transition: transform 0.2s;">
                            <style>
                                img:hover {
                                    transform: scale(1.2);
                                }
                            </style>
                    </td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $customer->email }}</td>
                </tr>
                <tr>
                    <th>Password:</th>
                    <td>{{ $customer->password }}</td>
                </tr>
                <tr>
                    <th>Country:</th>
                    <td>{{ $customer->country }}</td>
                </tr>
                <tr>
                    <th>State:</th>
                    <td>{{ $customer->state }}</td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td>{{ $customer->city }}</td>
                </tr>
                <tr>
                    <th>Address 1:</th>
                    <td>{{ $customer->Address_1 }}</td>
                </tr>
                <tr>
                    <th>Address 2:</th>
                    <td>{{ $customer->Address_2 }}</td>
                </tr>
                <tr>
                    <th>Postal Code:</th>
                    <td>{{ $customer->postalcode }}</td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td>{{ $customer->phone }}</td>
                </tr>
                <tr>
                    <th>Created At:</th>
                    <td>{{ $customer->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At:</th>
                    <td>{{ $customer->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
