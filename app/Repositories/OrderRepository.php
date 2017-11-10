<?php

namespace App\Repositories;

use App\Contracts\OrderInterface;
use App\Order;
use App\Contracts\OrderProductInterface;

class OrderRepository extends Repository implements OrderInterface
{
    /**
     * Order product object.
     *
     * @var App\Contracts\OrderProductInterface
     */
    protected $orderProduct;

    /**
     * Create new instance of order repository.
     *
     * @param Order              $order        Order model
     * @param OrderProductObject $orderProduct Order product interface
     */
    public function __construct(Order $order, OrderProductInterface $orderProduct)
    {
        parent::__construct($order);
        $this->order = $order;
        $this->orderProduct = $orderProduct;
    }

    /**
     * Store user order.
     *
     * @param  object $user User object
     * @return int
     */
    public function order($user)
    {
        $id = $this->order->insertGetId([
            'user_id' => $user->id,
            'status' => 0
        ]);

        if (! $this->orderProduct->orderItems($id, $user)) {
            return false;
        }

        return true;
    }

    /**
     * Retrieve user orders.
     *
     * @return array object
     */
    public function getUserOrders()
    {
        return $this->order->where('user_id', auth()->user()->id)
            ->with(['orderProduct' => function ($query) {
                return $query->with('product');
            }])->get();
    }

    /**
     * Retrieve all orders.
     *
     * @return array object
     */
    public function getAllOrders()
    {
        return $this->order->with([
            'user',
            'orderProduct' => function ($query) {
                return $query->with('product');
            }])->get();
    }

    /**
     * Confirm order
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function confirmOrder($request)
    {
        $order = $this->order->findOrFail($request->id);
        $order->status = 1;

        if ($order->save()) {
            return true;
        }

        return false;
    }

    /**
     * Cancel order
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function cancelOrder($request)
    {
        if ($this->order->findOrFail($request->id)->delete()) {
            return true;
        }

        return false;
    }
}
