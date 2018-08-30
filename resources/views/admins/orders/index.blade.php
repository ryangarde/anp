@extends('admins.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="card"  style="padding: 10px">
    <table class="table table-hover">
        <thead>
            <tr>
                <th></th>
                <th>Reference #</th>
                <th>Name</th>
                <th>Status</th>
                <th colspan="2">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->created_at->diffForHumans() }}</td>
                <td>{{ sprintf('%010d', $order->id) }}</td>
                <td>
                    <a class="card-title" data-toggle="modal" data-target="#customerModal" style="color: blue; cursor: pointer;">
                        {{ $order->user->name }}
                    </a>
                    @include('admins.layouts.modal')
                </td>
                <td>
                    @if ($order->status == 0)
                    <span class="float-left text-info">Pending</span>
                    @elseif ($order->status == 1)
                    <span class="float-left text-warning">48 hrs expired!</span>
                    @elseif ($order->status == 2)
                    <span class="float-left text-danger">Cancelled</span>
                    @elseif ($order->status == 3)
                    <span class="float-left text-success">Confirmed</span>
                    @elseif ($order->status == 4)
                    <span class="float-left text-success">Paid</span>
                    @elseif ($order->status == 5)
                    <span class="float-left text-success">Delivered</span>
                    @endif
                </td>
                <td><a href="/orders/{{ $order->id }}" class="btn btn-primary btn-sm">View Order</a></td>
                <td>
                    @if ($order->status == 0)
                    <a href="/orders/confirm/{{ $order->id }}" class="btn btn-success btn-sm">Confirm</a>
                    @elseif ($order->status == 1)
                    <a href="/orders/cancel/{{ $order->id }}" class="btn btn-danger btn-sm">Cancel</a>
                    @elseif ($order->status == 3)
                    <a href="/orders/paid/{{ $order->id }}" class="btn btn-success btn-sm">Paid</a>
                    @elseif ($order->status == 4)
                    <a href="/orders/delivered/{{ $order->id }}" class="btn btn-success btn-sm">Delivered</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection
{{-- @foreach ($orders->chunk(3) as $chunk)
<div class="row">
    @foreach ($chunk as $order)

    <div class="col-md-4">

        <div class="card text-center">
            <div class="card-header">
                {{ $order->created_at->diffForHumans() }}
            </div>
            <div class="card-body">
                <h5>
                    <a class="card-title" data-toggle="modal" data-target="#customerModal" style="color: blue; cursor: pointer;">
                        {{ $order->user->name }}
                    </a>
                </h5>
                Reference #: <span style="font-size: 17px">{{ sprintf('%010d', $order->id)}}</span>
                <p class="card-text">Total Amount:  ₱ <span style="font-size: 17px">{{ $order->total }}</span></p>
                <a href="/orders/{{ $order->id }}" class="btn btn-primary btn-sm">View Order</a>
            </div>
            <div class="card-footer text-muted clearfix">
                @if ($order->status == 0)
                <span class="float-left text-info">Pending</span>
                @elseif ($order->status == 1)
                <span class="float-left text-warning">48 hrs expired!</span>
                @elseif ($order->status == 2)
                <span class="float-left text-danger">Cancelled</span>
                @elseif ($order->status == 3)
                <span class="float-left text-success">Confirmed</span>
                @endif
                @if ($order->status == 0)
                <form method="POST" action="/orders/confirm/{{ $order->id }}">
                    {{ csrf_field() }}
                    <input type="submit" class="float-right btn btn-success btn-sm" value="Confirm">
                </form>

                @elseif ($order->status == 1)
                <form method="POST" action="/orders/cancel/{{ $order->id }}">
                    {{ csrf_field() }}
                    <input type="submit" class="float-right btn btn-danger btn-sm" value="Cancel">
                </form>
                @endif
            </div>

        </div>

    </div>

    @endforeach
    <div class="w-100"></div><br>
</div>
@endforeach --}}



