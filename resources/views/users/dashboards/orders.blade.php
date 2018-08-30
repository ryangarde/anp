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
                Reference #
                <h5 class="card-title">{{ sprintf('%010d', $order->id) }}</h5>
                <p class="card-text">{{-- Total Amount: ₱ {{ $order->total }} --}}</p>
                <a href="/orders/{{ $order->id }}" class="btn anp-btn btn-sm">View Order</a>
            </div>
            <div class="card-footer text-muted">
                @if ($order->status == 0)
                <span class="text-info">Pending</span>
                @elseif ($order->status == 1)
                <span class="text-warning">48 hrs has expired!</span>
                @elseif ($order->status == 2)
                <span class="text-danger">Cancelled</span>
                @elseif ($order->status == 3)
                <span class="text-success">Confirmed</span>
                @elseif ($order->status == 4)
                <span class="text-success">Paid</span>
                @elseif ($order->status == 5)
                <span class="text-success">Delivered</span>
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
