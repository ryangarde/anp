<?php

namespace App\Http\Controllers\Admins;

use App\Contracts\OrderInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderProduct;


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
     * @var App\Contracts\OrderInterface
     */
    protected $orderProduct;

    /**
     * Create new instance of orders controller.
     *
     * @param OrderInterface $order Order interface
     */
    public function __contruct(OrderInterface $order, OrderProductInterface $orderProduct)
    {
        $this->order = $order;
        $this->orderProduct = $orderProduct;
    }

    public function index()
    {
        $orders = Order::with([
            'orderProduct' => function ($query) {
                $query->with('product');
            }
        ])->get();

        return view('admins.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        $orderProducts = OrderProduct::all();
        $orderProducts = $orderProducts->where('order_id',$order->id);

        return view('admins.orders.show', compact('orderProducts','order'));
    }

    public function confirm(Order $order)
    {
        $order->fill([
            'status' => 1
        ]);
        $order->save();
        return back();
    }

    public function cancel(Order $order)
    {
        $order->fill([
            'status' => 3
        ]);
        $order->save();
        return back();
    }
}
