<?php

namespace App\Repositories;

use App\Contracts\OrderProductInterface;
use App\Contracts\ShoppingCartInterface;
use App\OrderProduct;

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
}
