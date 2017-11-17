@extends('users.layouts.app-dashboard')

@section('title', 'Dashboard | Shopping Cart')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Dashboards</a>
    <span class="breadcrumb-item">Shopping Cart</span>
</nav>

<table class="table table-responsive table-striped background">
    <caption>List of products in your shopping cart</caption>
    <thead class="thead-dark">
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Sub Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->shoppingCart as $product)
        <tr>
            <td><img class="img-fluid" style="max-width: 220px;" src="{{ asset('storage/images/' . $product->image) }}"></td>
            <td style="max-width: 300px;">
                <span class="text-success">Name</span>
                <br>
                {{ $product->name }}
                <br><br>
                <span class="text-success">Description</span>
                <p style="font-size: 85%;">
                    {{ $product->description }} Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua.
                </p>
            </td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <th>₱ {{ $product->subTotal }}</th>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td colspan="2">Total Items</td>
            <td>{{ $user->totalItems }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2">Grand Total</td>
            <td>₱ {{ $user->grandTotal }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2">Discount</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2"><a href="{{ route('shop') }}" class="btn btn-sm btn-success">Continue Shopping</a></td>
            <td>
                <form id="order-form" method="POST" action="{{ route('orders.order') }}" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <button class="btn btn-sm btn-info">Order</button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
@endsection
