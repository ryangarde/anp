@extends('admins.layouts.app')

@section('title', 'Dashboards - Assign Permissions to a Role')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Roles</a>
    <span class="breadcrumb-item">Role List</span>
</nav>

<div class="card">
    <div class="card-header">
        Assign Permissions to {{ $role->display_name }} Role
        @if (session('message'))
        <div class="float-right text-success">
            {{ session('message') }}
        </div>
        <br>
        @endif
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($permissions as $permission)
                        <tr>
                            <form id="assign-permission-form" action="{{ route('roles.toggle-permission') }}" method="POST" accept-charset="utf-8">
                                {{ csrf_field() }}
                                <input type="hidden" name="role_id" value="{{ $role->id }}">
                                <input type="hidden" name="permission_id" value="{{ $permission['id'] }}">
                                <td>{{ $permission['name'] }}</td>
                                <td>{{ $permission['display_name'] }}</td>
                                <td>{{ $permission['description'] }}</td>
                                <td>
                                    @if ( ! $permission['assigned'])
                                    <span class="text-danger">Unassign</span>
                                    @else
                                    <span class="text-success">Assign</span>
                                    @endif
                                </td>
                                <td>
                                    @if ( ! $permission['assigned'])
                                    {{-- <button type="submit" class="text-success">Assign</button> --}}
                                    <a class="text-success" href="#" onclick="event.preventDefault();document.getElementById('assign-permission-form').submit();">
                                        Assign
                                    </a>
                                    @else
                                    {{-- <button type="submit" class="text-danger">Unassign</button> --}}
                                    <a class="text-danger" href="#" onclick="event.preventDefault();document.getElementById('assign-permission-form').submit();">
                                        Unassign
                                    </a>
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
            </div>
        </div>
    </div>
</div>
@endsection
