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
                @elseif ($order->status == 2)
                <span class="float-left text-warning">Requesting for Cancellation</span>
                @else
                <span class="float-left text-danger">Cancelled</span>
                @endif
                @if ($order->status == 0)
                <form method="POST" action="/orders/confirm/{{ $order->id }}">
                    {{ csrf_field() }}
                    <input type="submit" class="float-right btn btn-primary btn-sm" value="Confirm">

                </form>
                {{-- <a href="{{ route('admins.orders.confirm', $order->id) }}" class="float-right btn btn-primary btn-sm">Confirm</a> --}}
                @elseif ($order->status == 2)
                <form method="POST" action="/orders/cancel/{{ $order->id }}">
                    {{ csrf_field() }}
                    <input type="submit" class="float-right btn btn-danger btn-sm" value="Cancel">
                </form>
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
