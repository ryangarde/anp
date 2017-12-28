@extends('users.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div style="position: relative; width: 100%; height: 100%;">
    <img class="img-fluid" src="{{ asset('storage/home-banner.jpg') }}">
    <div style="position: absolute; top: 0; left: 0; width: inherit; height: inherit; background-color: rgba(0, 0, 0, 0.5);">
        
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-header">
            Home Page
        </div>
    </div>
</div>
@endsection
