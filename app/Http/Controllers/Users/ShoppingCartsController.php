<?php

namespace App\Http\Controllers\Users;

use App\Contracts\ProductInterface;
use App\Contracts\ShoppingCartInterface;
use App\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoppingCartsController extends Controller
{
    /**
     * Product object.
     *
     * @var App\Contracts\ProductInterface
     */
    protected $product;

    /**
     * Shopping cart object.
     *
     * @var App\Contracts\ShoppingCartInterface
     */
    protected $shoppingCart;

    /**
     * User object.
     *
     * @var App\Contracts\UserInterface
     */
    protected $user;

    /**
     * Create new instance of product object.
     *
     * @param ProductInterface      $product      Product interface
     * @param ShoppingCartInterface $shoppingCart Shopping cart interface
     * @param UserInterface         $user         User interface
     */
    public function __construct(
        ProductInterface      $product,
        ShoppingCartInterface $shoppingCart,
        UserInterface         $user
    ) {
        $this->product      = $product;
        $this->shoppingCart = $shoppingCart;
        $this->user         = $user;
    }

    public function index()
    {
        $shoppingCart = $this->user->shoppingCart();

        return view('users.dashboards.shopping-cart', compact('shoppingCart'));
    }

    public function showCartItems()
    {
        $shoppingCart = $this->user->shoppingCart();

        return view('users.dashboards.cart-items', compact('shoppingCart'));
    }
    /**
     * Add item to cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        // Check if item exists in the shopping cart.
        if ($this->user->addToCart($request)) {
            return back()->with('message', 'Product successfully added.');
        }

        return back()->with('message', 'Product updated.');
    }

    /**
     * Remove item from cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart(Request $request)
    {
        if ($this->user->removeFromCart($request)) {
            return redirect()->route('carts.items')->with('message', 'Successfully removed from shopping cart.');
        }

        return redirect()->route('carts.items')->with('message', 'Something went wrong.');
    }

    /**
     * Add quantity to item in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addQuantity(Request $request)
    {
        if ($this->user->addQuantity($request)) {
            return redirect()->route('carts.items')->with('message', 'Successfully added a quantity.');
        }

        return redirect()->route('carts.items')->with('message', 'Whopps something went wrong.');
    }

    /**
     * Subtract quantity to item in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subtractQuantity(Request $request)
    {
        if ($this->user->subtractQuantity($request)) {
            return redirect()->route('carts.items')->with('message', 'Successfully subtracted a quantity.');
        }

        return redirect()->route('carts.items')->with('message', 'Whopps something went wrong.');
    }
}
