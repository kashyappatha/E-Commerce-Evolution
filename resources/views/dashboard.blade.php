@extends('layouts.app')

@section('title', 'Welcome To Dashboard!!')

@section('contents')
    <style>
        /* Custom CSS */
        /* .email-scroll {
                                                        padding: 3px;
                                                        background-color: #f7f7f7;
                                                    } */

        .email-scroll p {
            padding: 3px;
            background-color: #f7f7f7;
        }

        .text-muted {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-body h5 {
            margin-bottom: 10px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>

    <div class="container">

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Category Data</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Product Data</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>User Data</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Manage Roles Data</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <h5 class="card-title" data-toggle="collapse" data-target="#profileCard">Profiles</h5>
                        <hr />
                        <div id="profileCard" class="collapse">
                            <div class="text-center">
                                <img src="{{ asset('admin_assets/img/' . auth()->user()->profile_image) }}"
                                    alt="Profile Image" class="img-fluid rounded-circle mb-3" style="max-width: 100px;">
                                <h4 class="mb-0">{{ auth()->user()->name }}</h4>
                                <div class="email-scroll">
                                    <p class="text-muted">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name:</th>
                                        <td>{{ auth()->user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ auth()->user()->email }}</td>
                                    </tr>
                                    @php $changeCount = 0; @endphp
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
