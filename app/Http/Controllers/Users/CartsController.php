<?php

namespace App\Http\Controllers\Users;

use App\Contracts\ProductInterface;
use App\Contracts\ShoppingCartInterface;
use App\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartsController extends Controller
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

    /**
     * Add to cart
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Not logged in!'
            ], 401);
        }

        if (!$this->product->findOrFail($request->id)) {
            return response()->json([
                'message' => 'Product not found!'
            ], 404);
        }

        if (!$this->user->addToCart($request)) {
            return response()->json([
                'message' => 'Opps! Something went wrong!'
            ], 404);
        }

        return response()->json([
            'message' => 'Product added successfully!'
        ], 200);
    }
}
