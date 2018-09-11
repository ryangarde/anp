@extends('users.layouts.app-dashboard')

@section('title','Dashboard | Shopping Cart')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboards</a>
    <a class="breadcrumb-item" href="{{ route('shopping-cart') }}">Shopping Cart</a>
    <span class="breadcrumb-item">Cart Items</span>
</nav>

@if($shoppingCart['total_items'] == 0)
<br><br><br>
<span style="font-size: 30px; color: red"><center>No items in cart</center></span>
@else
<table class="table table-responsive table-hover background">
    <thead>
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Price</th>
            <th></th>
            <th>Quantity</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($shoppingCart['products'] as $product)
        <tr>
            <td><img class="img-fluid" style="max-width: 220px;" src="{{ asset('storage/images/' . $product['image']) }}"></td>
            <td>{{ $product['name'] }}</td>
            <td>{{ $product['price'] }}</td>
            <td>{{ $product['retail_size'] }}</td>
            <td>{{ $product['quantity'] }}</td>
            <td>
                <form method="POST" action="{{ route('carts.remove-from-cart') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                    <button type="submit" class="btn anp-btn btn-sm ">
                        Remove
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
