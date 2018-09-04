@extends('admins.layouts.app')

@section('title', 'List of Customers')

@section('content')
<nav class="breadcrumb">
    <span class="breadcrumb-item">Customers</span>
</nav>

<div class="card">
    <div class="card-header">
        List of Customers
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a class="card-title user-link" href="{{ route('admins.users.show',$user->id) }}">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('admins.users.showOrders',$user->id) }}">Show Orders</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
</div>

@endsection
