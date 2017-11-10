<?php

namespace App\Contracts;

interface UserInterface
{
    /**
     * Add item to cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function addToCart($request);

    /**
     * Remove item from the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function removeFromCart($request);

    /**
     * Add quantity to item in the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function addQuantity($request);

    /**
     * Subtract quantity to item in the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function subtractQuantity($request);

    /**
     * Check if cart is empty.
     *
     * @return boolean
     */
    public function isShoppingCartEmpty();

    /**
     * Retrieve items in the cart.
     *
     * @return json object
     */
    public function shoppingCart();

    /**
     * Remove all items in the cart.
     *
     * @return boolean
     */
    public function clearShoppingCart();

    /**
     * Retrieve all orders for the user.
     *
     * @return json object
     */
    public function getOrders();
}
