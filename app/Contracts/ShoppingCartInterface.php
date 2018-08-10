<?php

namespace App\Contracts;

interface ShoppingCartInterface
{
    /**
     * Check if cart is empty.
     *
     * @return boolean
     */
    public function isShoppingCartEmpty();

    /**
     * Check if item exists in the cart.
     *
     * @param  int     $id
     * @return boolean
     */
    public function checkIfItemExists($id);

    /**
     * Store the data in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function store($request);

    /**
     * Add quantity to item in the cart.
     *
     * @param  integer $id
     * @return boolean
     */
    public function addQuantity($id);

    /**
     * Subtract quantity to item in the cart.
     *
     * @param  integer $id
     * @return boolean
     */
    public function subtractQuantity($id);

    /**
     * Retrieve all items from user cart.
     *
     * @return json object
     */
    public function getItems();

    /**
     * Remove all items in the cart.
     *
     * @return boolean
     */
    public function clearShoppingCart();
}
