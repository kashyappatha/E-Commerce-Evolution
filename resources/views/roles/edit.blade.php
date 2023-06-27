@extends('layouts.app')

@section('contents')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('roles.update', $role->id) }}">
        @csrf
        @method('PUT')

        <table class="table table-bordered">
            <tr>
                <th>Name:</th>
                <td>
                    {{-- <select name="roleName" class="form-control" id="roles">
                        <option value="">Select Role</option>
                        @foreach($roles as $r)
                            <option value="{{ $r->id }}" {{ $role->id == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                        @endforeach
                    </select> --}}
                    <input type="text" name="name" placeholder="Name" class="form-control" value="{{$role->name}}">
                </td>


            </tr>
            <tr>
                <th>Permissions</th>
                <td>
                    @foreach ($permission as $value)
                        <label><input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name"
                                {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                            {{ $value->name }}</label><br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </td>
            </tr>
        </table>
    </form>
@endsection
