@extends('layouts.app')

@section('contents')
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
        <td>
            <span  style="display: inline-block; padding: 10px 12px;border-radius: 4px;font-weight:bold;color:white; " class="badge rounded-pill {{ $role->name === 'Admin' ? 'bg-success text-light' : 'bg-primary text-light' }}">
                <i class="{{ $role->name === 'Admin' ? 'fas fa-user' : 'fas fa-crown' }}"></i>
                {{ $role->name }}
            </span>
        </td>

        <td>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <span style="display: inline-block; padding: 5px 10px; background-color: green; color: white; border-radius: 4px; margin-right: 5px;"> <i class="fas fa-check-circle me-1">{{ $v->name }}</i></span>
                @endforeach
            @endif
        </td>
    </tr>
</table>
@endsection
