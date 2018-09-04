@extends('admins.layouts.app')

@section('title','View Customer')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admins.users.index') }}">Customers</a>
    <span class="breadcrumb-item">View Customer</span>
</nav>

<div class="card">
    <div class="card-header">
        <span style="font-size: 16px">{{ $user->name }}</span>
    </div>
    <div class="card-body" style="padding: 40px">
        <b>Email:</b> {{ $user->email }}<br><br>
        <b>Phone Number:</b> {{ $user->phone_number }}<br><br>
        <b>Lot/Block No.:</b> {{ $user->lot_block }}<br><br>
        <b>Street:</b> {{ $user->street }}<br><br>
        <b>Subdivision/Barangay:</b> {{ $user->subdivision_barangay }}<br><br>
        <b>City/Municipality:</b> {{ $user->city_municipality }}<br><br>
        <b>Province:</b> {{ $user->province }}<br><br>
        <b>Zip Code:</b> {{ $user->zip_code }}<br><br>
    </div>
    <div class="card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">Back</a>
    </div>
</div>
@endsection
