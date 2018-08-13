@extends('users.layouts.app-dashboard')

@section('title', 'Dashboard | Orders')

@section('content')

<div class="card text-center">
    <div class="card-body">
        <table class="table table-responsive table-striped background">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderProduct as $order)
                <tr>
                    <td><img class="img-fluid" style="max-width: 220px;" src="{{ asset('storage/images/' . $order->product->image) }}"></td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->product->price }}</td>
                    <td>{{ $order->quantity }}</td>
                </tr>
                 @endforeach
            </tbody>
        </table>
        <a href="/orders" class="btn btn-primary">Back</a>

        <form method="POST" action="/orders/{{ $id }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Cancel</button>
        </form>

    </div>
</div>


@endsection
