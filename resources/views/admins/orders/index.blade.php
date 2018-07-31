@extends('admins.layouts.app')

@section('title', 'Dashboard')

@section('content')
@foreach ($orders->chunk(3) as $chunk)
<div class="row">
    @foreach ($chunk as $order)
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header">
                {{ $order->created_at->diffForHumans() }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Order Number {{ $order->id }}</h5>
                <p class="card-text">Total Amount: {{ $order->grandTotal }}</p>
                <a href="#" class="btn btn-primary btn-sm">View Products</a>
            </div>
            <div class="card-footer text-muted clearfix">
                @if ($order->status == 0)
                <span class="float-left text-info">Pending</span>
                @elseif ($order->status == 1)
                <span class="float-left text-success">Confirmed</span>
                @else
                <span class="float-left text-danger">Cancelled</span>
                @endif
                @if ($order->status == 0)
                <a href="{{ route('admins.orders.confirm', $order->id) }}" class="float-right btn btn-primary btn-sm">Confirm</a>
                @elseif ($order->status == 1)
                <a href="{{ route('admins.orders.cancel', $order->id) }}" class="float-right btn btn-danger btn-sm">Cancel</a>
                @else
                @endif
            </a>
        </div>
    </div>
</div>
@endforeach
<div class="w-100"></div><br>
@endforeach
@endsection
