@extends('users.layouts.app')

@section('title', 'Shop')

@section('content')
<div style="position: relative; width: 100%; height: 100%;">
    <img class="img-fluid" src="{{ asset('images/shop-banner-300.jpg') }}">
    <div class="shop-header-cover">
        <h1 class="shop-header-cover-title">Shop</h1>
    </div>
</div>

<div class="d-flex align-content-center justify-content-center text-center">
    @if (Request::is('v2') || Request::is('v2/shop'))
        @include('users.layouts.navbar-v2')
    @else
        @include('users.layouts.navbar')
    @endif
</div>

<div class="container mb-5 mt-4">
    <div class="row">
        <div class="col-md-3">
            @include('users.shop.filter')
        </div>
        <div class="col-md-9">
            <div class="card-columns">
                @foreach ($products as $index => $product)
                <form action="{{ route('shop.show',$product->id) }}" method="GET" accept-charset="utf-8">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value="{{ $product->name }}">
                    <div class="card title-color text-center shop-cart-item" style="border: 0">
                        <div>
                            {{ strtoupper($product->name) }}
                        </div>
                        @foreach ($product->images as $index => $image)
                            @if ($index == 0)
                            <div onclick="location.href='/shop/{{ $product->id }}';" style="background: url('storage/images/{{ $image->image }}') no-repeat center/cover; width: 100%; height: 230px; cursor: pointer; border-radius: 4px"></div>
                            @endif
                        @endforeach
                        <br>
                        <div class="d-flex justify-content-between mb-2">
                            @foreach ($product->productRetailSizes as $index => $price)
                                @if($index == 0)
                                <div class="d-inline-block" style="font-size: 120%">
                                    ₱ {{ $price->price }}
                                </div>
                                @endif
                            @endforeach
                            <button type="submit" class="btn btn-sm add-to-cart-button anp-btn">
                              View Product
                            </button>
                        </div>

                        @if (strlen($product->description) >= 120)
                            <div class="c--anim-btn">
                                <span class="c-anim-btn">
                                    {{ $product->retail_size }}
                                    <br><br>
                                    {{ $product->description }}
                                </span>
                            </div>
                        @else
                            <div style="font-size: 85%; color: #707070">
                                {{ $product->retail_size }}
                                <br><br>
                                {{ $product->description }}
                            </div>
                        @endif

                        <hr>
                    </div>
                </form>
                @endforeach
            </div>
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

        /*$('.add-to-cart-button').on('click', function(event) {
            event.preventDefault()

            let productId = $(this).attr('product-id')
            let form = $('#add-to-cart-form')

            form.find('input[name="product_id"]').val(productId)
            form.submit()
        })*/
    })
</script>
@endsection
