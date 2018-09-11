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
            @if(isset($order->created_at))
            <div class="col-md-4">{{ $order->created_at->toDayDateTimeString() }}</div>
            @endif
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
            @if(isset($order->receipt_date))
            <div class="col-md-4">{{ $order->receipt_date->toDayDateTimeString() }}</div>
            @endif
        </div>
        <br>
        <div class="row">
            <div class="col-md-2">Receipt #:</div>
            <div class="col-md-4"><input type="text" name="receipt" class="form-control" value="{{ $order->receipt }}" disabled></div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>

<br>

<div class="card">
    <div class="card-header">
        MERCHANDISE SECTION
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
                    <th>Quantity</th>
                    <th>Shipment</th>
                    <th>Amount</th>
                    <th>In stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderProducts as $index => $orderProduct)
                <tr>
                    <td>{{ str_limit($orderProduct->product->producer->name, 10) }}</td>
                    <td>{{ $orderProduct->product->name }}</td>
                    <td>{{ $orderProduct->product->category->name }}</td>
                    <td>{{ number_format($price[$index]->price,2) }}</td>
                    <td>{{ $orderProduct->retailSize->name }}</td>
                    <td style="text-align: center">{{ $orderProduct->quantity }}</td>
                    <td><input type="text" name="shipment" id="shipment" class="form-control" value="{{ $orderProduct->shipment }}" disabled></td>
                    <td>₱ {{ number_format($amount[$index],2) }}</td>
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
                <tr>
                    <td colspan="6"></td>
                    <th>Sub Total</th>
                    <td style="border-top: 1px solid black">₱ {{ number_format($subtotal,2) }}</td>
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
                <tr>
                    <td colspan="6"></td>
                    <th>Total</th>
                    <td style="border-top: 1px solid black">₱ {{ number_format($total,2) }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    @if($order->status != 5)
    <div class="card-footer">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-sm-6">
                        @if ($order->status == 0)
                            @if(!empty($order->receipt))
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
                        @if($order->status < 4)
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
    @endif
</div>
<br>
@if ($order->status == 5)
<div class="card">
    <div class="card-header">
        RETURNED GOODS
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
                    <th>Quantity Returned</th>
                    <th>Amount Returned</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderProducts as $index => $orderProduct)
                <tr>
                    <td>{{ str_limit($orderProduct->product->producer->name, 10) }}</td>
                    <td>{{ $orderProduct->product->name }}</td>
                    <td>{{ $orderProduct->product->category->name }}</td>
                    <td>{{ number_format($price[$index]->price,2) }}</td>
                    <td>{{ $orderProduct->retailSize->name }}</td>
                    <td><input type="number" name="quantity_returned[]" class="form-control" value="{{ $orderProduct->quantity_returned }}" disabled></td>
                    <td>₱ {{ number_format($amount_returned[$index],2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5"></td>
                    <th>Total returned</th>
                    <td style="border-top: 1px solid black">₱ {{ number_format($total_returned,2) }}</td>
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
                    </div>
                    <div class="col-xs-3">
                        <a href="{{ route('admins.orders.edit',$order->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@include('admins.modals.users')
@endsection
