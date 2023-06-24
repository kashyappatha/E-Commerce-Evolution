@extends('layouts.app')
@section('category', 'Create category')
@section('contents')
    <marquee direction="up" scrollamount="5">
        <h1 class="mb-0 bg-primary text-white">Add Category</h1>
    </marquee>
    <hr />
    <form action="{{ route('categories.store') }}" method="GET" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered shadow rounded-lg">
            <tr>
                <td>
                    <label class="form-label">Category:</label>
                    <input type="text" name="category" class="form-control" placeholder="Enter Your Category" required>
                </td>
                <td>
                    <label class="form-label">Image:</label>
                    <input type="file" name="image" class="form-control" placeholder="Enter Files Here"
                        accept="jpg/png/jpeg" required>
                </td>
                <td>
                    <label class="form-label">Status:</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="activeStatus" value="Active"
                                required>
                            <label class="form-check-label" for="activeStatus">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inactiveStatus"
                                value="Inactive" required>
                            <label class="form-check-label" for="inactiveStatus">Inactive</label>
                        </div>
                    </div>
                </td>
            </tr>
            {{-- <tr>
                <td>
                    <label class="form-label">Availability:</label>
                    <select name="availability" id="availability-select" class="form-control" required>
                        <option value="">Select Availability Type:</option>
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </td>
            </tr> --}}
        </table>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" style="width:100px;">Submit</button><br />
                <button type="reset" class="btn btn-primary" style="width:100px;">Reset</button><br />
                <button class="btn btn-primary" style="width:100px;">Back</button>
            </div>
        </div>
    </form>
@endsection
