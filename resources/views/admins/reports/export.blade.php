<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Reference #</th>
                <th>Order Date</th>
                <th>Receipt created at</th>
                <th>Receipt #</th>
                <th>Prepared by</th>
                <th>Customer</th>
                <th>Producer</th>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Retail Size</th>
                <th>Quantity</th>
                <th>Shipment</th>
                <th>Amount</th>
                <th>In stock</th>
                <th>Discounts</th>
                <th>Sub Total</th>
                <th>Quantity Returned</th>
                <th>Amount Returned</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderProducts as $index => $orderProduct)
            <tr>
                <td>{{ sprintf('%010d', $orderProduct->order->id) }}</td>
                <td>{{ $orderProduct->order->created_at }}</td>
                <td>{{ $orderProduct->order->receipt_date }}</td>
                <td>{{ $orderProduct->order->receipt }}</td>
                <td>{{ $orderProduct->order->admin->name }}</td>
                <td>{{ $orderProduct->order->user->name }}</td>
                <td>{{ $orderProduct->product->producer->name }}</td>
                <td>{{ $orderProduct->product->name }}</td>
                <td>{{ $orderProduct->product->category->name }}</td>
                <td>{{ $price[$index]->price }}</td>
                <td>{{ $orderProduct->retailSize->name }}</td>
                <td>{{ $orderProduct->quantity }}</td>
                <td>{{ $orderProduct->shipment }}</td>
                <td>{{ $amount[$index] }}</td>
                <td>
                    @if($orderProduct->in_stock == 1)
                    Available
                    @else
                    Item not in stock
                    @endif
                </td>
                <td>{{ $discount[$index] }}</td>
                {{-- @if($index == $lastIndex)
                    @if($count > 0 || $orderProducts[$index]->order->id == $orderProducts[$index-1]->order->id)
                        <td>{{ null }}</td>
                    @endif
                @elseif(isset($orderProducts[$index+1]->order->id))
                    @if($count > 0 || $orderProducts[$index]->order->id == $orderProducts[$index+1]->order->id)
                        <td>{{ null }}</td>
                    @else
                        <td>{{ $orderProduct->order->discount }}</td>
                    @endif
                @else
                    <td>{{ $orderProduct->order->discount }}</td>
                @endif --}}
                <td>{{ $subtotal[$index] }}</td>
                <td>{{ $orderProduct->quantity_returned }}</td>
                <td>{{ $amount_returned[$index] }}</td>
            </tr>
            {{-- @if($index == $lastIndex)
                @if($count > 0 || $orderProducts[$index]->order->id == $orderProducts[$index-1]->order->id)
                    <tr>
                        <td>{{ sprintf('%010d', $orderProducts[$index]->order->id) }}</td>
                        <td>{{ $orderProducts[$index]->order->created_at }}</td>
                        <td>{{ $orderProducts[$index]->order->receipt_date }}</td>
                        <td>{{ $orderProducts[$index]->order->receipt }}</td>
                        <td></td>
                        <td>{{ $orderProducts[$index]->order->user->name }}</td>
                        <td colspan="9"></td>
                        <td>{{ $orderProducts[$index]->order->discount }}</td>
                    </tr>
                @endif
            @endif
            @if(isset($orderProducts[$index+1]->order->id))
                @if($orderProducts[$index]->order->id == $orderProducts[$index+1]->order->id)
                {{ $count = $count + 1 }}
                @else
                    @if($count > 0)
                        <tr>
                            <td>{{ sprintf('%010d', $orderProducts[$index]->order->id) }}</td>
                            <td>{{ $orderProducts[$index]->order->created_at }}</td>
                            <td>{{ $orderProducts[$index]->order->receipt_date }}</td>
                            <td>{{ $orderProducts[$index]->order->receipt }}</td>
                            <td></td>
                            <td>{{ $orderProducts[$index]->order->user->name }}</td>
                            <td colspan="9"></td>
                            <td>{{ $orderProducts[$index]->order->discount }}</td>
                        </tr>
                    @endif
                    {{ $count = 0 }}
                @endif
            @endif --}}
            @endforeach

        </tbody>
    </table>
</body>
</html>
