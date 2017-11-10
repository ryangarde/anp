@extends('users.layouts.app')

@section('title', 'Shop')

@section('content')
<div class="container mb-5">
    <div class="row">
        <div class="col-md-3">
            @include('users.shop.filter')
        </div>
        <div class="col-md-9">
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
                        <a href="{{ route('products.show', $product->id) }}" class="float-right card-link text-success font-weight-bold">Add to Cart</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
