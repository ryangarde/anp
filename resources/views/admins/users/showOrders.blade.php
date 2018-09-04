@extends('admins.layouts.app')

@section('title', 'List of Orders')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admins.users.index') }}">Customers</a>
    <span class="breadcrumb-item">List of Orders</span>
</nav>
<div class="card">
    <div class="card-header">
        {{ $user->name }}'s Orders
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Reference No.</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ sprintf('%010d', $order->id) }}</td>
                    <td>
                        @if ($order->status == 0)
                        <span class="float-left text-info">Pending</span>
                        @elseif ($order->status == 1)
                        <span class="float-left text-warning">48 hrs expired!</span>
                        @elseif ($order->status == 2)
                        <span class="float-left text-danger">Cancelled</span>
                        @elseif ($order->status == 3)
                        <span class="float-left text-success">Confirmed</span>
                        @elseif ($order->status == 4)
                        <span class="float-left text-success">Paid</span>
                        @elseif ($order->status == 5)
                        <span class="float-left text-success">Delivered</span>
                        @endif
                    </td>
                    <td><a href="/orders/{{ $order->id }}" class="btn btn-primary btn-sm">View Order</a></td>
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
