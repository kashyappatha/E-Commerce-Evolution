@extends('layouts.app')

@section('title', 'Show Product')

@section('contents')
    <div class="card shadow rounded-lg">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Detail category</h1>
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Category_Image:</th>
                            <td><img src="{{ asset('admin_assets/img/' . $category->image) }}" alt="Image"
                                    style="max-width: 130px; border-radius: 10px;transition: transform 0.2s;">
                                    <style>
                                        img:hover {
                                            transform: scale(1.3);
                                        }
                                    </style>
                                </td>
                        </tr>
                        <tr>
                            <th>Category:</th>
                            <td>{{ $category->category }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if ($category->status === 'Active')
                                    <span class="badge rounded-pill text-success bg-success text-light font-weight-bold"><i
                                            class="fas fa-check-circle me-1">{{ $category->status }}</i></span>
                                @else
                                    <span class="badge rounded-pill text-danger bg-danger text-light font-weight-bold"><i
                                            class="fas fa-times-circle me-1">{{ $category->status }}</i></span>
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <th>created_at:</th>
                            <td>{{ $category->created_at }}</td>
                        </tr>
                        <tr>
                            <th>updated_at:</th>
                            <td>{{ $category->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
