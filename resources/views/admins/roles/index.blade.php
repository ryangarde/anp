@extends('admins.layouts.app')

@section('title', 'Dashboards - Role List')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Roles</a>
    <span class="breadcrumb-item">Role List</span>
</nav>

<div class="card">
    <div class="card-header">
        Role List
        <a href="{{ route('roles.create') }}" class="float-right text-success">Create New Role</a>
    </div>
    <div class="card-body">
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        <br>
        @endif
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                <a href="{{ route('roles.show', $role->id) }}" class="text-dark">View</a> | 
                                <a href="{{ route('roles.show-assign-permissions-form', $role->id) }}" class="text-success">Assign Permissions</a> |
                                <a href="{{ route('roles.destroy', $role->id) }}" class="text-danger" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                                    Delete
                                </a>
                                <form id="delete-form" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>

                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
