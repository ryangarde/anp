@extends('admins.layouts.app')

@section('title', 'Dashboards - Assign Roles to a User')

@section('content')
<div class="card">
    <div class="card-header">
        Assign Roles to {{ $admin->name }}
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
                        @forelse ($roles as $role)
                        <tr>
                            <form id="assign-role-form" action="{{ route('admins.toggle-role') }}" method="POST" accept-charset="utf-8">
                                {{ csrf_field() }}
                                <input type="hidden" name="admin_id" value="{{ $admin->id }}">
                                <input type="hidden" name="role_id" value="{{ $role['id'] }}">
                                <td>{{ $role['name'] }}</td>
                                <td>{{ $role['display_name'] }}</td>
                                <td>{{ $role['description'] }}</td>
                                <td>
                                    @if ( ! $role['assigned'])
                                    <span class="text-danger">Unassign</span>
                                    @else
                                    <span class="text-success">Assign</span>
                                    @endif
                                </td>
                                <td>
                                    @if ( ! $role['assigned'])
                                    <a class="text-success" href="#" onclick="event.preventDefault();document.getElementById('assign-role-form').submit();">
                                        Assign
                                    </a>
                                    @else
                                    <a class="text-danger" href="#" onclick="event.preventDefault();document.getElementById('assign-role-form').submit();">
                                        Unassign
                                    </a>
                                    @endif
                                </td>
                            </form>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4"><a href="{{ route('roles.create') }}" class="btn btn-sm btn-success">Create New Role</a></td>
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
