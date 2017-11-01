@extends('admins.layouts.app')

@section('title', 'Dashboards - Assign Permissions to a Role')

@section('content')
<h1>Assign Permissions to {{ $role->display_name }} Role</h1>
<br>
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
<h4>Permission List</h4>


<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Display Name</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($permissions as $permission)
        <tr>
            <form action="{{ route('roles.toggle-permission') }}" method="POST" accept-charset="utf-8">
                {{ csrf_field() }}
                <input type="hidden" name="role_id" value="{{ $role->id }}">
                <input type="hidden" name="permission_id" value="{{ $permission['id'] }}">
                <td>{{ $permission['name'] }}</td>
                <td>{{ $permission['display_name'] }}</td>
                <td>
                    @if ( ! $permission['assigned'])
                    <span class="text-danger">Unassign</span>
                    @else
                    <span class="text-success">Assign</span>
                    @endif
                </td>
                <td>
                    @if ( ! $permission['assigned'])
                    <button type="submit" class="btn btn-sm btn-success">Assign</button>
                    @else
                    <button type="submit" class="btn btn-sm btn-danger">Unassign</button>
                    @endif
                </td>
            </form>
        </tr>
        @empty
        <tr>
            <td colspan="4"><a href="{{ route('permissions.create') }}" class="btn btn-sm btn-success">Create New Permission</a></td>
        </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
@endsection
