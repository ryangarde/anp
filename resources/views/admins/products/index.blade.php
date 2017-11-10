@extends('admins.layouts.app')

@section('title', 'Product List')

@section('content')
<div class="card">
    <div class="card-header">
        Product List
        <a href="{{ route('products.create') }}" class="float-right text-success">Create New Product</a>
    </div>
</div>

<br>

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
        </ul>
        <div class="card-body clearfix">
            <a href="{{ route('products.show', $product->id) }}" class="float-left card-link text-info font-weight-bold">View</a>
            <span class="float-right">{{ $product->producer->name }}</span>
        </div>
    </div>
    @endforeach
</div>
@endsection
