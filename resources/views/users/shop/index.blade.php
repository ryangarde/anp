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
                    <div class="card title-color text-center" style="border: 0">
                        <div>
                            {{ strtoupper($product->name) }}
                        </div>

                        <div style="background: url('/storage/images/{{ $product->image }}') no-repeat center/cover; width: 100%; height: 230px"></div>
                        <div class="d-flex justify-content-between mb-2">
                            <div class="d-inline-block" style="font-size: 120%">
                                ₱ {{ $product->price }}
                            </div>


                            <div class="d-inline-block">
                                <a href="#" class="btn btn-sm add-to-cart-button anp-btn" product-id="{{ $product->id }}">add to cart</a>
                            </div>
                        </div>

                        @if (strlen($product->description) >= 120)
                            <div class="c--anim-btn">
                                    <span class="c-anim-btn">
                                        {{ $product->description }}
                                    </span>
                            </div>
                        @else
                            <div style="font-size: 85%; color: #707070">
                                {{ $product->description }}
                            </div>
                        @endif

                        <hr>
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
