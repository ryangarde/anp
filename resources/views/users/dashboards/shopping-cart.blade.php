@extends('users.layouts.app-dashboard')

@section('title','Dashboard | Shopping Cart')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
    <span class="breadcrumb-item">Shopping Cart</span>
    <a href="{{ route('carts.items') }}" class="btn anp-btn btn-sm float-right">Go to Cart</a>
</nav>
@if($shoppingCart['total_items'] == 0)
<br><br><br>
<span style="font-size: 30px; color: red"><center>No items in cart</center></span>
@else
<table class="table table-responsive table-striped background">
    <caption>List of products in your shopping cart</caption>
    <thead class="thead-dark">
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Product</th>
            <th>Price</th>
            <th width="18%"></th>
            <th scope="col" width="10%">Quantity</th>
            <th scope="col">Sub Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($shoppingCart['products'] as $product)
        <tr>
            <td><img class="img-fluid" style="max-width: 220px;" src="{{ asset('storage/images/' . $product['image']) }}"></td>
            <td style="max-width: 300px;">
                <span class="text-success">Name</span>
                <br>
                {{ $product['name'] }}
                <br><br>
                <span class="text-success">Description</span>
                <p style="font-size: 85%;">
                    {{ $product['description'] }}
                </p>
            </td>
            <td>₱ {{ $product['price'] }}</td>
            <td>{{ $product['retail_size'] }}</td>
            <td>{{ $product['quantity'] }}</td>
            <th>₱ {{ $product['sub_total'] }}</th>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Total Items</td>
            <td colspan="2">{{ $shoppingCart['total_items'] }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Grand Total</td>
            <td style="border-top: 1px solid black"></td>
            <th style="border-top: 1px solid black;">₱ {{ $shoppingCart['grand_total'] }}</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2"></td>
            <td colspan="2">with additional shipment fee</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2">Discount</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td></td>
            <td colspan="2"><a href="{{ route('shop') }}" class="btn btn-sm btn-success">Continue Shopping</a></td>
            <td>
                <form id="order-form" method="POST" action="{{ route('orders.order') }}" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <input type="hidden" name="total" value="{{ $shoppingCart['grand_total'] }}">
                    <button class="btn btn-sm btn-info" style="cursor: pointer;">Checkout</button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
@endif
@endsection
