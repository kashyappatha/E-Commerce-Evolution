@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Show Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
        </div>
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Permissions</th>
    </tr>
    <tr>
        <td>{{ $role->name }}</td>
        <td>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <span class="label label-success">{{ $v->name }}</span>
                @endforeach
            @endif
        </td>
    </tr>
</table>
@endsection
