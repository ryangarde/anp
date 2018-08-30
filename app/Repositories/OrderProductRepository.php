<?php

namespace App\Repositories;

use App\Contracts\OrderProductInterface;
use App\Contracts\ShoppingCartInterface;
use App\ProductRetailSize;
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
                'quantity' => $item['quantity'],
                'retail_size_id' => $item['retail_size_id']
            ]);
        }

        return true;
    }

    /**
     * Retrieve all products in an order.
     *
     * @return array object
     */
    public function getProducts($id)
    {
        $order = Order::find($id);

        $orderProducts = $this->orderProduct
                            ->where('order_id',$order->id)
                            ->get()
                            ->map(function ($item) {
                                return [
                           //         'id' => $item->id,
                                    'product' => $item->product->name,
                                    'retail_size' => $item->retailSize->name,
                                    'in_stock' => $item->in_stock,
                                    'price' => $item->retailSize->productRetailSizes
                                                ->where('product_id',$item->product->id)
                                                ->where('retail_size_id',$item->retail_size_id)
                                                ->first()
                                                ->price,
                                    'shipment' => $item->shipment,
                                    'quantity' => $item->quantity,
                                    'amount' => $item->retailSize->productRetailSizes
                                                ->where('product_id',$item->product->id)
                                                ->where('retail_size_id',$item->retail_size_id)
                                                ->first()
                                                ->price * $item->quantity
                                ];
                            });


        return collect($orderProducts);
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


