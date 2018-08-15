@extends('admins.layouts.app')

@section('title' , 'Orders')

@section('content')
<div class="card">
    <div class="card-header">
        Order Number {{ $order->id }}
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderProducts as $orderProduct)
                <tr>
                    <td>{{ $orderProduct->product->name }}</td>
                    <td>{{ $orderProduct->product->price }}</td>
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
