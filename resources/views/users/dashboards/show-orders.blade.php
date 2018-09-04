@extends('users.layouts.app-dashboard')

@section('title', 'Dashboard | Orders')

@section('content')

<div class="card text-center">
    <div class="card-header">
        @if ($order->status == 0)
        <span class="float-center text-info">Pending</span>
        @elseif ($order->status == 1)
        <span class="float-center text-warning">48 hrs expired!</span>
        @elseif ($order->status == 2)
        <span class="float-center text-danger">Cancelled</span>
        @elseif ($order->status == 3)
        <span class="float-center text-success">Confirmed</span>
        @elseif ($order->status == 4)
        <span class="float-center text-success">Paid</span>
        @elseif ($order->status == 5)
        <span class="float-center text-success">Delivered</span>
        @endif
    </div>
    <div class="card-body">
        <table class="table table-responsive table-striped background">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th></th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    @if($order->status >= 3)
                    <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($orderProducts as $index => $orderProduct)
                <tr>
                    <td style="text-align: left">{{ $orderProduct['product'] }}</td>
                    <td style="text-align: left">{{ $orderProduct['price'] }}</td>
                    <td style="text-align: left">{{ $orderProduct['retail_size'] }}</td>
                    <td style="text-align: left">{{ $orderProduct['quantity'] }}</td>
                    <td style="text-align: left">₱ {{ $orderProduct['amount'] }}</td>
                    <td style="text-align: left">
                    @if($order->status >= 3)
                        @if($orderProduct['in_stock'] == 0)
                        <span class="text-danger">Product out of stock!</span>
                        @else
                        <span class="text-success">Available</span>
                        @endif
                    @endif
                    </td>
                </tr>
                @endforeach
                @if($order->status >= 3)
                    @if($shipment != 0 || $discount != 0)
                    <tr>
                        <td colspan="3" style="text-align: left"></td>
                        <th>Subtotal</th>
                        <td style="text-align: left; border-top: 1px solid black">₱ {{ $subtotal }}</td>
                        <td></td>
                    </tr>
                    @endif
                    @if($shipment != 0)
                    <tr>
                        <td colspan="3"></td>
                        <th>Shipment</th>
                        <td style="text-align: left">₱ {{ $shipment }}</td>
                        <td></td>
                    </tr>
                    @endif
                    @if($discount != 0)
                    <tr>
                        <td colspan="3" style="text-align: left"></td>
                        <th>Discount</th>
                        <td style="text-align: left">{{ $discount }} %</td>
                        <td></td>
                    </tr>
                    @endif

                @endif
                <tr>
                    <td colspan="3"></td>
                    <th>Total</th>
                    <td style="text-align: left; border-top: 1px solid black">₱ {{ $total }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <a href="/orders" class="float-left btn btn-secondary btn-sm">Back</a>
{{--         <form method="POST" action="/orders/{{ $id }}">
            {{ csrf_field() }}
            <button type="submit" class="float-left btn btn-danger btn-sm">Cancel</button>
        </form> --}}
    </div>
</div>


@endsection
