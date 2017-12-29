@extends('users.layouts.app')

@section('title', 'Shop')

@section('content')

<div style="position: relative; width: 100%; height: 100%;">
    <img class="img-fluid" src="{{ asset('storage/shop-banner-300.jpg') }}">
    <div class="shop-header-cover">
        <h1 class="shop-header-cover-title">Shop</h1>
    </div>
</div>

<div class="container mb-5 mt-4">
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
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush custom-list-group">
                        <li class="list-group-item">₱ {{ $product->price }}</li>
                    </ul>
                    <div class="card-body clearfix">
                        <span class="float-left pt-1">{{ $product->producer->name }}</span>
                        <a href="#" class="float-right card-link btn btn-sm btn-theme-color add-to-cart-button" product-id="{{ $product->id }}">Add to Cart</a>
                    </div>
                </div>
                @endforeach
            </div>

            <form id="add-to-cart-form" action="{{ route('carts.add-to-cart') }}" method="POST" accept-charset="utf-8">
                {{ csrf_field() }}

                <input type="hidden" name="product_id" value="">
            </form>

            <div class="mx-auto mt-4" style="width: 50px;">
                {{ $products->links('vendor.pagination.bootstrap-4') }}
                {{-- <button class="btn btn-sm btn-secondary-color" href="#">Load More</button> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#price-slider").slider({})

        $('.add-to-cart-button').on('click', function(event) {
            event.preventDefault()

            let productId = $(this).attr('product-id')
            let form = $('#add-to-cart-form')

            form.find('input[name="product_id"]').val(productId)
            form.submit()
        })
    })
</script>
@endsection
