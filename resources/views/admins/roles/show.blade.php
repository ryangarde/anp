@extends('admins.layouts.app')

@section('title', 'Dashboards - Create New Role')

@section('content')
<h1>View {{ $role->display_name }} Role</h1>
<br>
<h4>{{ $role->display_name }} assigned permissions</h4>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Display Name</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->display_name }}</td>
        </tr>
        @empty
        <tr>
            <td><span>Empty</span></td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="form-group">
    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info btn-sm">Edit {{ $role->display_name }} Role</a>
    <a href="{{ route('roles.show-assign-permissions-form', $role->id) }}" class="btn btn-success btn-sm">Assign Permissions</a>
</div>
@endsection
