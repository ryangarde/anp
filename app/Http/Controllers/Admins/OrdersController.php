<?php

namespace App\Http\Controllers\Admins;

use App\Order;
use Illuminate\Http\Request;
use App\Contracts\OrderInterface;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Order object.
     *
     * @var App\Contracts\OrderInterface
     */
    protected $order;

    /**
     * Create new instance of orders controller.
     *
     * @param OrderInterface $order Order interface
     */
    public function __contruct(OrderInterface $order)
    {
        $this->order = $order;
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

    public function confirm(Request $request)
    {
        $order = Order::findOrFail($id);
        $order->fill([
            'status' => 1
        ]);

        return $order->save();
    }
}
