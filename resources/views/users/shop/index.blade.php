@extends('users.layouts.app')

@section('title', 'Shop')

@section('content')
<div class="container mb-5">
    <div class="row">
        <div class="col-md-3">
            @include('users.shop.filter')
        </div>
        <div class="col-md-9">
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            <br>
            @endif
            <div class="card-columns">
                @foreach ($products as $product)
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/images/' . $product->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">₱ {{ $product->price }}</li>
                        <li class="list-group-item">{{ $product->producer->name }}</li>
                    </ul>
                    <div class="card-body clearfix">
                        <a href="{{ route('products.show', $product->id) }}" class="float-left card-link text-info">View</a>

                        <a href="#" class="float-right card-link text-success" onclick="event.preventDefault();document.getElementById('add-to-cart-form').submit();">Add to Cart</a>
                        <form id="add-to-cart-form" action="{{ route('carts.add-to-cart') }}" method="POST" accept-charset="utf-8">
                            {{ csrf_field() }}

                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#price-slider").slider({});
    });
</script>
@endsection
