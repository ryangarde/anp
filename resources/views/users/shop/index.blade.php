@extends('users.layouts.app')

@section('title', 'Shop')

@section('content')
    {{--<div class="container-fluid" style="height: 450px; background: url('/images/shop-banner.jpg') no-repeat center/cover">--}}

    {{--</div>--}}
    {{--<div class="container-fluid px-md-5 my-md-4 my-2">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-5">--}}
                {{--<div class="d-flex text-center">--}}
                    {{--<div class="d-inline-block">--}}
                        {{--<img class="img-fluid mb-1" src="{{ asset('images/dti.jpg') }}" height="64" width="250" alt="">--}}
                    {{--</div>--}}
                    {{--<div class="d-inline-block">--}}
                        {{--<img class="img-fluid" src="{{ asset('images/otop.png') }}" height="32" width="100" alt="">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-3 text-center my-1">--}}
                {{--<h1 style="color: #C24C2E; font-size: 450%; font-weight: 400">SHOP</h1>--}}
            {{--</div>--}}

            {{--<div class="col-md-4 text-center">--}}
                {{--<span class="badge badge-pill badge-danger ml-4 mt-1" style="position: absolute">3</span>--}}
                {{--<button class="btn btn-outline-danger btn-cart"><img src="{{ asset('images/cart.png') }}" alt=""></button>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="row mt-3">--}}
            {{--<div class="col-md-3">--}}
                {{--@include('users.shop.filter')--}}
            {{--</div>--}}
            {{--<div class="col-md-9">--}}
                {{--<div class="card-columns">--}}
                    {{--<div class="card text-center" style="border: 0; color: #A31D15;">--}}
                        {{--<div class="header" style="color: #A31D15; font-weight: 700; font-size: 115%">Product</div>--}}
                        {{--<div style="background: url('/images/sample.jpg') no-repeat center/cover; width: 100%; height: 230px"></div>--}}
                        {{--<div class="my-2">--}}
                            {{--<span style="font-size: 110%; font-weight: 600">P 1,300.00</span>--}}
                            {{--<div class="float-right">--}}
                                {{--<a href="">add</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="c--anim-btn">--}}
                            {{--<span class="c-anim-btn">--}}
                                {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores doloribus dolorum ducimus facere facilis numquam officia praesentium, quia quos soluta unde, velit voluptate! Fugit placeat quisquam recusandae repudiandae sed vel.--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="card text-center" style="border: 0; color: #A31D15;">--}}
                        {{--<div class="header" style="color: #A31D15; font-weight: 700; font-size: 115%">Product</div>--}}
                        {{--<div style="background: url('/images/sample.jpg') no-repeat center/cover; width: 100%; height: 230px"></div>--}}
                        {{--<div class="my-2">--}}
                            {{--<span style="font-size: 110%; font-weight: 600">P 1,300.00</span>--}}
                            {{--<div class="float-right">--}}
                                {{--<a href="">add</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="c--anim-btn">--}}
                            {{--<span class="c-anim-btn">--}}
                                {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores doloribus dolorum ducimus facere facilis numquam officia praesentium, quia quos soluta unde, velit voluptate! Fugit placeat quisquam recusandae repudiandae sed vel.--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="card text-center" style="border: 0; color: #A31D15;">--}}
                        {{--<div class="header" style="color: #A31D15; font-weight: 700; font-size: 115%">Product</div>--}}
                        {{--<div style="background: url('/images/sample.jpg') no-repeat center/cover; width: 100%; height: 230px"></div>--}}
                        {{--<div class="my-2">--}}
                            {{--<span style="font-size: 110%; font-weight: 600">P 1,300.00</span>--}}
                            {{--<div class="float-right">--}}
                                {{--<a href="">add</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="c--anim-btn">--}}
                            {{--<span class="c-anim-btn">--}}
                                {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores doloribus dolorum ducimus facere facilis numquam officia praesentium, quia quos soluta unde, velit voluptate! Fugit placeat quisquam recusandae repudiandae sed vel.--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
<div class="container mb-5" style="margin-top: 100px">
    <div class="container-fluid px-md-5 my-md-4 my-2">
        <div class="row">
            <div class="col-md-5">
                <div class="d-flex text-center">
                    <div class="d-inline-block">
                        <img class="img-fluid mb-1" src="{{ asset('images/dti.jpg') }}" height="64" width="250" alt="">
                    </div>
                    <div class="d-inline-block">
                        <img class="img-fluid" src="{{ asset('images/otop.png') }}" height="32" width="100" alt="">
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-center my-1">
                <h1 style="color: #C24C2E; font-size: 450%; font-weight: 400">SHOP</h1>
            </div>

            <div class="col-md-4 text-center">
                <span class="badge badge-pill badge-danger ml-4 mt-1" style="position: absolute">3</span>
                <button class="btn btn-outline-danger btn-cart"><img src="{{ asset('images/cart.png') }}" alt="">
                </button>
            </div>
        </div>
    </div>
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
                        <a href="#" class="float-right card-link text-success add-to-cart-button" product-id="{{ $product->id }}">Add to Cart</a>
                    </div>
                </div>
                @endforeach
            </div>

            <form id="add-to-cart-form" action="{{ route('carts.add-to-cart') }}" method="POST" accept-charset="utf-8">
                {{ csrf_field() }}

                <input type="hidden" name="product_id" value="">
            </form>
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
