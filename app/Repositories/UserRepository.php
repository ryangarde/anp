<?php

namespace App\Repositories;

use App\Contracts\OrderInterface;
use App\Contracts\ShoppingCartInterface;
use App\Contracts\UserInterface;
use App\User;

class UserRepository extends Repository implements UserInterface
{
    /**
     * Order object.
     *
     * @var App\Contracts\OrderInterface
     */
    protected $order;

    /**
     * Shopping cart object.
     *
     * @var App\Contracts\ShoppingCartInterface
     */
    protected $shoppingCart;

    /**
     * Create new instance of user repository.
     *
     * @param User                  $user         User model
     * @param OrderInterface        $order        Order interface
     * @param ShoppingCartInterface $shoppingCart Shopping cart interfaces
     */
    public function __construct(
        User $user,
        OrderInterface $order,
        ShoppingCartInterface $shoppingCart
    ) {
        parent::__construct($user);
        $this->user         = $user;
        $this->order        = $order;
        $this->shoppingCart = $shoppingCart;
    }

    /**
     * Add item to cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function addToCart($request)
    {
        if (! $this->shoppingCart->checkIfItemExists($request->product_id)) {
            if ($this->shoppingCart->store($request)) {
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * Remove item from the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function removeFromCart($request)
    {
        if ($this->shoppingCart->destroy($request->product_id)) {
            return true;
        }

        return false;
    }

    /**
     * Add quantity to item in the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function addQuantity($request)
    {
        if ($this->shoppingCart->addQuantity($request->product_id)) {
            return true;
        }

        return false;
    }

    /**
     * Subtract quantity to item in the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function subtractQuantity($request)
    {
        if ($this->shoppingCart->subtractQuantity($request->product_id)) {
            return true;
        }

        return false;
    }

    /**
     * Check if user cart is empty.
     *
     * @return boolean
     */
    public function isShoppingCartEmpty()
    {
        return $this->shoppingCart->isShoppingCartEmpty();
    }

    /**
     * Retrieve items in the cart.
     *
     * @return json object
     */
    public function shoppingCart()
    {
        return $this->shoppingCart->getItems();
    }

    /**
     * Remove all items in the cart.
     *
     * @return boolean
     */
    public function clearShoppingCart()
    {
        return $this->shoppingCart->clearShoppingCart();
    }

    /**
     * Retrieve all orders for the user.
     *
     * @return json object
     */
    public function getOrders()
    {
        return $this->order->getUserOrders();
    }
}
