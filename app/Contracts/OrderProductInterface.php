<?php

namespace App\Contracts;

interface OrderProductInterface
{
    /**
     * Retrieve order items.
     *
     * @param  int    $id   Order id
     * @param  object $user User object
     * @return boolean
     */
    public function orderItems($id, $user);
}
