<?php

namespace App\Repositories;

use App\Contracts\OrderProductInterface;
use App\OrderProduct;

class OrderProductRepository extends Repository implements OrderProductInterface
{
    /**
     * Create new instance of order product repository.
     *
     * @param OrderProduct $orderProduct Order product repository.
     */
    public function __construct(OrderProduct $orderProduct)
    {
        parent::__construct($orderProduct);
        $this->orderProduct = $orderProduct;
    }

    /**
     * Retrieve order items.
     *
     * @param  int    $id   Order id
     * @param  object $user User object
     * @return boolean
     */
    public function orderItems($id, $user)
    {
        foreach ($user->shoppingCart as $item) {
            $this->orderProduct->create([
                'order_id' => $id,
                'product_id' => $item->id,
                'quantity' => $item->quantity
            ]);
        }

        return true;
    }
}
