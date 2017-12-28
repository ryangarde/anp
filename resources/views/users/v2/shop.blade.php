@extends('users.layouts.app')

@section('title', 'Official Website of the Association of Negros Producers')

@section('content')
    <div class="container-fluid" style="background: url('/images/shop-banner-2.jpg') no-repeat top/cover; height: 400px"></div>

    <div class="container-fluid">
        <div class="row my-5 text-center">
            <div class="col-md-4">
                <img class="mr-1" src="{{ asset('images/dti.jpg') }}" alt="" height="60">
                <img src="{{ asset('images/otop.png') }}" alt="" height="60">
            </div>
            
            <div class="col-md-5">
                <h1 class="title-color">SHOP</h1>
            </div>
            
            <div class="col-md-3">
                <a href="{{ route('shopping-cart') }}" class="btn btn-cart"><img src="{{ asset('images/cart.png') }}" alt=""></a>
            </div>
        </div>

        <div class="row mx-md-3 mx-1 mb-5">
            <div class="col-md-3 px-4">
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