@extends('admins.layouts.app')

@section('title', 'View Product')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Products</a>
    <span class="breadcrumb-item">View Product</span>
</nav>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                View Product
                @if (session('message'))
                <div class="float-right text-success">
                    {{ session('message') }}
                </div>
                <br>
                @endif
            </div>
            <div class="card-body">
                <fieldset disabled>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="text" class="form-control" name="image" id="image" value="{{ $product->image }}">
                    </div>

                    <div class="form-group">
                        <label for="producer_id">Producer</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $product->producer->name }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="5">{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $product->category->name }}">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}">
                    </div>
                </fieldset>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" accept-charset="utf-8">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
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
    </div>
</div>
@endsection
