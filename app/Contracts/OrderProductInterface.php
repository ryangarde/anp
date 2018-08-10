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

    /**
     * Show ordered items
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function findOrFailWithOrder($id);
}
