@extends('users.layouts.app-dashboard')

@section('title', 'Dashboard | Orders')

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
            <div class="card-footer text-muted">
                @if ($order->status == 0)
                <span class="text-info">Pending</span>
                @elseif ($order->status == 1)
                <span class="text-success">Confirmed</span>
                @else
                <span class="text-danger">Cancelled</span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="w-100"></div><br>
@endforeach
{{-- {{ $orders->links('vendor.pagination.bootstrap-4') }} --}}
@endsection
