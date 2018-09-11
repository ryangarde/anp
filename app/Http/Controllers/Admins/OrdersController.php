<?php

namespace App\Http\Controllers\Admins;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderProduct;
use App\ProductRetailSize;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;

class OrdersController extends Controller
{
    /**
     * Order object.
     *
     * @var App\Contracts\OrderInterface
     */
    protected $order;

    /**
     * OrderProduct object.
     *
     * @var App\Contracts\OrderProductInterface
     */
    protected $orderProduct;

    /**
     * Create new instance of orders controller.
     *
     * @param OrderInterface $order Order interface
     */

    public function __contruct(Order $order, OrderProduct $orderProduct)
    {
        $this->order = $order;
        $this->orderProduct = $orderProduct;
        $this->excel = $excel;
    }

    public function index()
    {
        $orders = Order::with([
            'orderProduct' => function ($query) {
                $query->with('product');
            }
        ])
        ->orderBy('created_at','desc')
        ->get();

        /*if(empty($orders)){
            dd('hi');
        }
        else {
            dd('Hello');
        }*/
        foreach ($orders as $index => $order) {
            if($order->status > 2) {
                unset($orders[$index]);
            }
        }

        return view('admins.orders.index', compact('orders'));
    }

    public function indexConfirmed()
    {
        $orders = Order::with([
            'orderProduct' => function ($query) {
                $query->with('product');
            }
        ])
        ->orderBy('created_at','desc')
        ->get();

        foreach ($orders as $index => $order) {
            if($order->status < 3) {
                unset($orders[$index]);
            }
        }
        return view('admins.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $orderProducts = OrderProduct::where('order_id',$order->id)
                        ->with(['product'  => function ($query) {
                            $query->with('category','producer');
                            }
                        ])
                        ->get();
        foreach ($orderProducts as $index => $orderProduct) {
            $price[$index] = ProductRetailSize::where('product_id',$orderProduct->product->id)->where('retail_size_id',$orderProduct->retail_size_id)->get()->first();
            $shipment[$index] = $orderProduct->shipment;
            if($orderProduct->in_stock == 0) {
                $amount[$index] = 0;
            } else {
                $amount[$index] = $price[$index]->price * $orderProduct->quantity + $shipment[$index];
            }
            $amount_returned[$index] = $price[$index]->price * $orderProduct->quantity_returned;
        }
        $shipment = array_sum($shipment);
        $discount = $order->discount;
        $subtotal = array_sum($amount);
        $total_returned = array_sum($amount_returned);
        $total = (100 - $discount)/100 * $subtotal;
        return view('admins.orders.show', compact('orderProducts','order','price','amount','amount_returned','subtotal','total','total_returned'));
    }

    public function edit(Order $order)
    {
        $orderProducts = OrderProduct::where('order_id',$order->id)
                        ->with(['product'  => function ($query) {
                            $query->with('category','producer');
                            }
                        ])
                        ->get();

        foreach ($orderProducts as $index => $orderProduct) {
            $price[$index] = ProductRetailSize::where('product_id',$orderProduct->product->id)->where('retail_size_id',$orderProduct->retail_size_id)->get()->first();
            $shipment[$index] = $orderProduct->shipment;
            if($orderProduct->in_stock == 0) {
                $amount[$index] = 0;
            } else {
                $amount[$index] = $price[$index]->price * $orderProduct->quantity + $shipment[$index];
            }
            $amount_returned[$index] = $price[$index]->price * $orderProduct->quantity_returned;
        }
        $shipment = array_sum($shipment);
        $discount = $order->discount;
        $subtotal = array_sum($amount);
        $total = (100 - $discount)/100 * $subtotal;
        $total_returned = array_sum($amount_returned);
        return view('admins.orders.edit', compact('orderProducts','order','price','amount','amount_returned','subtotal','total','total_returned'));
    }

    public function update(Request $request, Order $order)
    {
        $this->validate($request,[
            'receipt' => 'integer'
        ]);
        if($request->quantity_returned || $request->shipment){
            $orderProducts = OrderProduct::where('order_id',$order->id)->get();
            foreach ($orderProducts as $index => $orderProduct) {
                $orderProduct->update(array('shipment' => $request->shipment[$index]));
            }
        }
        if($request->discount){
            $order->update(array('discount' => $request->discount));
        }
        if($request->in_stock){
            $orderProducts = OrderProduct::where('order_id',$order->id)->get();
            foreach ($orderProducts as $index => $orderProduct) {
                $orderProduct->update(array('in_stock' => $request->in_stock[$index]));
            }
        }
        if($request->quantity_returned){
            $orderProducts = OrderProduct::where('order_id',$order->id)->get();
            foreach ($orderProducts as $index => $orderProduct) {
                $orderProduct->update(array('quantity_returned' => $request->quantity_returned[$index]));
            }
        }
        if ($request->receipt) {
            $order->update(array('receipt' => $request->receipt, 'receipt_date' => $request->receipt_date));
        }

        return redirect()->route('admins.orders.show',$order->id);
    }

    public function confirm(Order $order)
    {

        $order->fill([
            'status' => 3,
            'admin_id' => auth('admin')->user()->id,
            'receipt_date' => Carbon::now()->toDateTimeString()
        ]);
        $order->save();
        return back();
    }

    public function cancel(Order $order)
    {

        $order->fill([
            'status' => 2
        ]);
        $order->save();
        return back();
    }

    public function paid(Order $order)
    {
        $order->fill([
            'status' => 4
        ]);
        $order->save();
        return back();
    }

    public function delivered(Order $order)
    {
        $order->fill([
            'status' => 5
        ]);
        $order->save();
        return back();
    }


}
