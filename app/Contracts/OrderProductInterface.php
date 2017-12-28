<?php

namespace App\Contracts;

interface OrderProductInterface
{
    /**
     * Retrieve order items.
     *
     * @param  int $id Order id
     * @return boolean
     */
    public function orderItems($id);
}
