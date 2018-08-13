<?php

namespace App\Repositories;

use App\Contracts\OrderInterface;
use App\Contracts\OrderProductInterface;
use App\Order;
use Carbon\Carbon;

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
     * @param Order                 $order        Order model
     * @param OrderProductInterface $orderProduct Order product interface
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
     * @return int
     */
    public function order()
    {
        $order = $this->order->create([
            'user_id' => auth()->user()->id,
            'status' => 0
        ]);

        if (! $this->orderProduct->orderItems($order->id)) {
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
        /*return $this->order->where('user_id', auth()->user()->id)
            ->with(['orderProduct' => function ($query) {
                return $query->with('product');
            }])->paginate(2);*/

        $orders = $this->order->with([
                'orderProduct' => function ($query) {
                    $query->with('product');
                }
            ])
            ->where('user_id', auth()->user()->id)
            ->get()
            ->map(function ($item) {
                return $item;
            });

        return $orders;

        /*return $this->order->where('user_id', auth()->user()->id)
            ->with(['orderProduct' => function ($query) {
                return $query->with('product');
            }])->paginate()->transform(function ($item) {
                $order = [];

                $order['id'] = $item->id;
                $order['user_id'] = $item->user_id;
                $order['status'] = $item->status;
                $order['created_at'] = new Carbon($item->created_at);
                $order['updated_at'] = $item->updated_at->toDateTimeString();

                if (! empty($item->deleted_at)) {
                    $order['deleted_at'] = $item->deleted_at->toDateTimeString();
                }

                $orderProducts = [];
                $totalItems = 0;
                $grandTotal = 0;

                foreach ($item->orderProduct as $orderProduct) {
                    $product = [];

                    $product['id'] = $orderProduct->product->id;
                    $product['image'] = $orderProduct->product->image;
                    $product['name'] = $orderProduct->product->name;
                    $product['description'] = $orderProduct->product->description;
                    $product['quantity'] = $orderProduct->quantity;
                    $product['price'] = $orderProduct->product->price;
                    $product['subTotal'] = $orderProduct->quantity * $orderProduct->product->price;

                    $orderProducts[] = $product;
                }

                $order['orderProduct'] = collect($orderProducts);
                $order['grandTotal'] = $order['orderProduct']->sum('subTotal');
                $order['totalItems'] = $order['orderProduct']->count();

                return collect($order);
            });*/
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
    public function cancelOrder($id)
    {
        if ($this->order->findOrFail($id)) {
            return true;
        }

        return false;
    }

    /**
     * change order status to '1'
     *
     */
    public function changeStatus($id)
    {
        $order = Order::find($id);
        $order->status = 2;
        $order->save();
    }
}
