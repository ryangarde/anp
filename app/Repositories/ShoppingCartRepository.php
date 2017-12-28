<?php

namespace App\Repositories;

use App\ShoppingCart;
use App\Contracts\ShoppingCartInterface;

class ShoppingCartRepository extends Repository implements ShoppingCartInterface
{
    /**
     * Create new instance of project repository.
     *
     * @param ShoppingCart $shoppingCart ShoppingCart repository.
     */
    public function __construct(ShoppingCart $shoppingCart)
    {
        parent::__construct($shoppingCart);
        $this->shoppingCart = $shoppingCart;
    }

    /**
     * Check if cart is empty.
     *
     * @return boolean
     */
    public function isShoppingCartEmpty()
    {
        if (! $this->shoppingCart->where('user_id', auth()->user()->id)->get()->count() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Check if item exists in the cart.
     *
     * @param  int     $id
     * @return boolean
     */
    public function checkIfItemExists($id)
    {
        if (! $this->shoppingCart->where('user_id', auth()->user()->id)->where('product_id', $id)->get()->count() > 0) {
            return false;
        }

        return true;
    }

    /**
     * Add quantity to item in the cart.
     *
     * @param  integer $id
     * @return boolean
     */
    public function addQuantity($id)
    {
        $product = $this->shoppingCart->where('user_id', auth()->user()->id)->where('product_id', $id)->first();
        $quantity = $product->quantity;
        $quantity++;
        $product->quantity = $quantity;
        $product->save();

        return true;
    }

    /**
     * Subtract quantity to item in the cart.
     *
     * @param  integer $id
     * @return boolean
     */
    public function subtractQuantity($id)
    {
        $product = $this->shoppingCart->where('user_id', auth()->user()->id)->where('product_id', $id)->first();

        if ($product->quantity == 1) {
            if ($this->destroy($id)) {
                return true;
            }
        }

        $quantity = $product->quantity;
        $quantity--;
        $product->quantity = $quantity;
        $product->save();

        return true;
    }

    /**
     * Retrieve all items from user cart.
     *
     * @return array object
     */
    public function getItems()
    {
        $products = $this->shoppingCart->with([
                'product' => function ($query) {
                    $query->with('producer', 'category');
                }
            ])
            ->where('user_id', auth()->user()->id)
            ->get()
            ->map(function ($item) {
                return [
                    'id'          => $item->product->id,
                    'producer'    => $item->product->producer->name,
                    'category'    => $item->product->category->name,
                    'image'       => $item->product->image,
                    'name'        => $item->product->name,
                    'description' => $item->product->description,
                    'quantity'    => $item->quantity,
                    'price'       => $item->product->price,
                    'sub_total'   => ($item->quantity * $item->product->price)
                ];
            });

        $shoppingCart = [
            'total_items' => $products->sum('quantity'),
            'grand_total' => $products->sum('sub_total'),
            'products'    => $products->all()
        ];

        return collect($shoppingCart);
    }

    /**
     * Remove the specified resource from the storage.
     *
     * @param  int $id
     * @return boolean
     */
    public function destroy($id)
    {
        if (! $this->shoppingCart->where('user_id', auth()->user()->id)->where('product_id', $id)->delete()) {
            return false;
        }

        return true;
    }

    /**
     * Remove all items in the cart.
     *
     * @return boolean
     */
    public function clearShoppingCart()
    {
        if (! $this->shoppingCart->where('user_id', auth()->user()->id)->delete()) {
            return false;
        }

        return true;
    }
}
