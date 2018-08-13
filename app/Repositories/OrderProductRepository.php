<?php

namespace App\Repositories;

use App\Contracts\OrderProductInterface;
use App\Contracts\ShoppingCartInterface;
use App\OrderProduct;
use App\Order;

class OrderProductRepository extends Repository implements OrderProductInterface
{
    /**
     * Shopping cart object.
     *
     * @var App\Contracts\ShoppingCartInterface
     */
    protected $shoppingCart;

    /**
     * Create new instance of order product repository.
     *
     * @param OrderProduct $orderProduct Order product repository.
     */
    public function __construct(OrderProduct $orderProduct, ShoppingCartInterface $shoppingCart)
    {
        parent::__construct($orderProduct);
        $this->orderProduct = $orderProduct;
        $this->shoppingCart = $shoppingCart;
    }

    /**
     * Retrieve order items.
     *
     * @param  int $id Order id
     * @return boolean
     */
    public function orderItems($id)
    {
        foreach ($this->shoppingCart->getItems()['products'] as $item) {
            $this->orderProduct->create([
                'order_id' => $id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity']
            ]);
        }

        return true;
    }

    /**
     * Retrieve a current order.
     *
     * @return array object
     */
    public function showOrder($id)
    {
        $order = Order::find($id);
        $orderProduct = $this->orderProduct->all();
        $orderProduct = $orderProduct->where('order_id',$order->id);

        return $orderProduct;
    }

    /**
     * Retrieve a list of products to be shown on email.
     *
     * @return array object
     */
    public function getProductList()
    {
        $id = OrderProduct::latest()->first();
        $products = OrderProduct::where('order_id',$id->order_id)->get();
        return $products;
    }

    /**
     * Show a single order with list of items.
     *
     * @return array object
     */
    public function findOrFailWithOrder($id)
    {
        return $this->model->with('order')->findOrFail($id);
    }
}


