<?php

namespace App\Contracts;

interface OrderInterface
{
    /**
     * Store user order.
     *
     * @param  object $user User object
     * @return int
     */
    public function order($user);

    /**
     * Retrieve user orders.
     *
     * @return array object
     */
    public function getUserOrders();

    /**
     * Retrieve all orders.
     *
     * @return array object
     */
    public function getAllOrders();

    /**
     * Confirm order
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function confirmOrder($request);

    /**
     * Cancel order
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function cancelOrder($request);
}
