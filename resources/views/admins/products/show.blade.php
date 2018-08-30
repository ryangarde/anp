@extends('admins.layouts.app')

@section('title', 'View Product')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="#">Products</a>
    <span class="breadcrumb-item">View Product</span>
</nav>

<div class="row">
    <div class="col-md-12">
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
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="image">Image</label>
                            @foreach($product->images as $image)
                            <input type="text" class="form-control" name="image" id="image" value="{{ $image->image }}">
                            @endforeach
                        </div>

                        <div class="form-group col-md-12">
                            <label for="producer_id">Producer</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $product->producer->name }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="5">{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="category_id">Category</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $product->category->name }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="price">Price</label>
                            @foreach($product->ProductRetailSizes as $retail)
                            <input type="text" class="form-control" name="price" id="price" value="{{ $retail->price }}">
                            @endforeach
                        </div>

                        <div class="form-group col-md-6">
                            <label for="retail_size">Retail Size</label>
                            @foreach($product->ProductRetailSizes as $retail)
                            <input type="text" class="form-control" name="retail_size" id="retail_size" value="{{ $retail->retailSize->name }}">
                            @endforeach
                        </div>
                    </div>

                </fieldset>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" accept-charset="utf-8">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#retail">
                      Add a Retail Size
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#imageModal">
                      Add an Image
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                    @include('admins.layouts.retail-modal')
                    @include('admins.layouts.image-modal')
            </div>
        </div>
    </div>

    {{-- <div class="col-md-4">
        <div class="card">
            <img class="card-img-top" src="{{ asset('storage/images/' . $product->image) }}" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">{{ $product->name }}</h4>
                <p class="card-text">{{ $product->description }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">₱ {{ $product->price }}</li>
            </ul>
            <div class="card-body">
                <span>{{ $product->producer->name }}</span>

            </div>
        </div>
    </div> --}}
</div>
@endsection
