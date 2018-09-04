@extends('admins.layouts.app')

@section('title' , 'Orders')

@section('content')

<div class="card">
    <div class="card-header">
        GENERAL SECTION
        @if ($order->status == 0)
        <span class="float-right text-info">Pending</span>
        @elseif ($order->status == 1)
        <span class="float-right text-warning">48 hrs expired!</span>
        @elseif ($order->status == 2)
        <span class="float-right text-danger">Cancelled</span>
        @elseif ($order->status == 3)
        <span class="float-right text-success">Confirmed</span>
        @elseif ($order->status == 4)
        <span class="float-right text-success">Paid</span>
        @elseif ($order->status == 5)
        <span class="float-right text-success">Delivered</span>
        @endif
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">Order Date: </div>
            <div class="col-md-4">{{ $order->created_at }}</div>
            <div class="col-md-2">Prepared by:</div>
            <div class="col-md-4">
                @if(! $order->admin_id == null)
                {{ $order->admin->name }}
                @endif
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">Reference #:</div>
            <div class="col-md-4">{{ sprintf('%010d', $order->id) }}</div>
            <div class="col-md-2">Customer:</div>
            <div class="col-md-4">
                <a class="card-title" data-toggle="modal" data-target="#customerModal" style="color: blue; cursor: pointer; font-size: 17px">
                    {{ $order->user->name }}
                </a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">Receipt created at:</div>
            <div class="col-md-4"><input type="date" name="receipt_date" class="form-control" value="{{ $order->receipt_date }}" disabled></div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">Receipt #:</div>
            <div class="col-md-4"><input type="text" name="receipt" class="form-control" value="{{ $order->receipt }}" disabled></div>
        </div>
    </div>
</div>

<br>

<div class="card">
    <div class="card-header">
        @if($order->status == 5)
        RETURNED GOODS
        @else
        MERCHANDISE SECTION
        @endif
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producer</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th></th>
                    @if($order->status == 5)
                    <th>Quantity Returned</th>
                    <th></th>
                    <th>Amount Returned</th>
                    @else
                    <th>Quantity</th>
                    <th>Shipment</th>
                    <th>Amount</th>
                    <th>In stock</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($orderProducts as $index => $orderProduct)
                <tr>
                    <td>{{ str_limit($orderProduct->product->producer->name, 10) }}</td>
                    <td>{{ $orderProduct->product->name }}</td>
                    <td>{{ $orderProduct->product->category->name }}</td>
                    <td>{{ $price[$index]->price }}</td>
                    <td>{{ $orderProduct->retailSize->name }}</td>

                    @if($order->status == 5)
                        <td><input type="number" name="quantity_returned[]" class="form-control" value="{{ $orderProduct->quantity_returned }}" disabled></td>
                    @else
                        <td style="text-align: center">{{ $orderProduct->quantity }}</td>
                    @endif

                    <td>
                        @if($order->status < 5)
                        <input type="text" name="shipment" id="shipment" class="form-control" value="{{ $orderProduct->shipment }}" disabled>
                        @endif
                    </td>

                    @if($order->status == 5)
                        <td>₱ {{ $amount_returned[$index] }}</td>
                    @else
                        <td>₱ {{ $amount[$index] }}</td>
                    @endif

                    <td>
                        @if($orderProduct->in_stock == 1)
                        <input type="hidden" name="in_stock[{{ $index }}]" value="0">
                        <input type="checkbox" name="in_stock[{{ $index }}]" class="form-control" value="1" checked disabled>
                        @else
                        <input type="hidden" name="in_stock[{{ $index }}]" value="0">
                        <input type="checkbox" name="in_stock[{{ $index }}]" class="form-control" value="1" disabled>
                        @endif
                    </td>
                </tr>
                @endforeach
                @if($order->status != 5)
                <tr>
                    <td colspan="6"></td>
                    <th>Sub Total</th>

                    @if($order->status == 5)
                        <td style="border-top: 1px solid black">₱ {{ $subtotal_returned }}</td>
                    @else
                        <td style="border-top: 1px solid black">₱ {{ $subtotal }}</td>
                    @endif

                    <td></td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                    <th>Discounts</th>
                    <td>
                        <input type="text" name="discount" class="form-control" value="{{ $order->discount }}" disabled>
                    </td>
                    <td></td>
                </tr>
                @endif
                <tr>
                    <td colspan="6"></td>
                    <th>Total</th>

                    @if($order->status == 5)
                        <td style="border-top: 1px solid black">₱ {{ $total_returned }}</td>
                    @else
                        <td style="border-top: 1px solid black">₱ {{ $total }}</td>
                    @endif
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-sm-6">
                        @if ($order->status == 0)
                            @if(! empty($order->receipt_date) && empty($order->eceipt))
                            <a href="/orders/confirm/{{ $order->id }}" class="btn btn-success">Confirm Order</a>
                            @endif
                        @elseif ($order->status == 1)
                        <a href="/orders/cancel/{{ $order->id }}" class="btn btn-danger">Cancel Order</a>
                        @elseif ($order->status == 3)
                        <a href="/orders/paid/{{ $order->id }}" class="btn btn-success">Paid</a>
                        @elseif ($order->status == 4)
                        <a href="/orders/delivered/{{ $order->id }}" class="btn btn-success">Delivered</a>
                        @endif
                    </div>
                    <div class="col-xs-3">
                        @if($order->status != 4)
                        <a href="{{ route('admins.orders.edit',$order->id) }}" class="btn btn-primary">Edit</a>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('admins.modals.users')
@endsection
