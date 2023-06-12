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
                            <th>Category:</th>
                            <td>{{ $category->category }}</td>
                        </tr>
                        <tr>
                            <th>Image:</th>
                            <td><img src="{{ asset('admin_assets/img/' . $category->image) }}" alt="Image"
                                    style="max-width: 70px; border-radius: 10px;"></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>{{ $category->status }}</td>
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
