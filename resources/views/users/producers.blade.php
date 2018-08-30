@extends('users.layouts.app')

@section('title', 'About Us')

@section('content')
<div style="position: relative; width: 100%; height: 100%;">
    <img class="img-fluid" src="{{ asset('images/contact-us-banner-300.jpg') }}">
    <div class="shop-header-cover">
        <h1 class="shop-header-cover-title">Producers</h1>
    </div>
</div>
<div class="d-flex align-content-center justify-content-center text-center">
    @if (Request::is('v2') || Request::is('v2/shop'))
        @include('users.layouts.navbar-v2')
    @else
        @include('users.layouts.navbar')
    @endif
</div>

<div class="container mb-5 mt-4 pt-5">
    @foreach($producers as $producer)
    <h4 class="text-color-theme">{{ $producer->name }}</h4>
    <br>
    @if(! empty($producer->website))
    Website: <a href="{{ $producer->website }}">{{ $producer->website }}</a>
    <br><br>
    @endif
    {{ $producer->description }}
    <br><br><br><br>
    @endforeach
</div>

@endsection
