@extends('admins.layouts.app')

@section('title', 'Dashboards - Permission List')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Permissions</a>
    <span class="breadcrumb-item">Permission List</span>
</nav>

<div class="card">
    <div class="card-header">
        Permission List
        <a href="{{ route('permissions.create') }}" class="float-right text-success">Create New Permission</a>
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
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->display_name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                <a href="{{ route('permissions.show', $permission->id) }}" class="text-dark">View</a> |
                                <a href="{{ route('permissions.destroy', $permission->id) }}" class="text-danger" onclick="event.preventDefault();document.getElementById('delete-form').submit();">
                                    Delete
                                </a>
                                <form id="delete-form" action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: none;">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>

                {{ $permissions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
