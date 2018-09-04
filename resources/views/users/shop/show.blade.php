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
    <br><br>
    <div class="row">
        <div class="col-md-5">
            @if(count($product->images) > 1)
                @include('users.layouts.image-carousel')
            @else
                @foreach($product->images as $index => $image)
                    @if (! empty($image->image))
                        <img class="shop-img-show" src="{{ asset('storage/images/'. $image->image)  }}" alt="Card image cap">
                    @endif
                @endforeach
            @endif
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6">
            <h3>{{ $product->name }}</h3><br>
            <span style="font-size: 15px;">{{ $product->description }}</span>
            <br><br><br>
            <span style="color: #990000;"><b>Produced by: </b></span><br><br>
            <h6>{{ $product->producer->name }}</h6><br>
            {{ $product->producer->description }}
            <br><br><br>
            @foreach($product->productRetailSizes as $index => $retail)
                @if($index == 0)
                <h3 style="color: red;">₱ {{ $retail->price }} <span style="font-size: 17px; color: black;">{{ $retail->retailSize->name }}</span></h3>
                @endif
            @endforeach
            <br><br>
            @if(count($product->productRetailSizes) > 1)
            Also available:<br><br>
            @endif
            @foreach($product->productRetailSizes as $index => $retail)
                @if($index > 0)
                <h6 style="color: red; font-size: 18px">₱ {{ $retail->price }}<span style="font-size: 14px; color: grey;"> {{ $retail->retailSize->name }}</span></h6>
                @endif
            @endforeach
            <br><br>
            <form id="add-to-cart-form" action="{{ route('carts.add-to-cart') }}" method="POST" accept-charset="utf-8">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="button" class="btn add-to-cart-button anp-btn" data-toggle="modal" data-target="#quantityModal">
                    ADD TO CART
                </button>
                @include('users.modals.add-to-cart-modal')
            </form>
        </div>


    </div>

</div>
@endsection
{{--
    <div class="d-inline-block">
        <input class="btn anp-btn" type="submit" value="ADD TO CART">
    </div>
</form> --}}
