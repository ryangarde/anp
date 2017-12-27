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
            ->map(function ($item, $key) {
                return [
                    'id' => $item->product->id,
                    'producer' => $item->product->producer->name,
                    'category' => $item->product->category->name,
                    'image' => $item->product->image,
                    'name' => $item->product->name,
                    'description' => $item->product->description,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'sub_total' => ($item->quantity * $item->product->price)
                ];
            });

        $shoppingCart = [
            'total_items' => $products->sum('quantity'),
            'grand_total' => $products->sum('sub_total'),
            'products' => $products->all()
        ];

        return collect($shoppingCart);

        /*->transform(function ($item) {
            $totalItems = null;
            $grandTotal = null;
            $products = [];

            foreach ($item as $shoppingCartItem) {
                $product = [
                    'id'          => $shoppingCartItem->product->id,
                    'image'       => $shoppingCartItem->product->image,
                    'name'        => $shoppingCartItem->product->name,
                    'description' => $shoppingCartItem->product->description,
                    'quantity'    => $shoppingCartItem->product->quantity,
                    'price'       => $shoppingCartItem->product->price,
                    'subTotal'    => $shoppingCartItem->quantity * $shoppingCartItem->product->price
                ];

                $totalItems = $totalItems + $shoppingCartItem->quantit;
                $grandTotal = $grandTotal + ($shoppingCartItem->quantity * $shoppingCartItem->product->price);

                array_push($products, $product);
            }
        });*/

        /*return auth()->user()->with(['shoppingCart' => function ($query) {
            return $query->with('product');
        }])->transform(function ($item) {
            $newItem = [];

            $newItem['id'] = $item->id;
            $newItem['name'] = $item->name;
            $newItem['email'] = $item->email;
            $newItem['phone_number'] = $item->phone_number;

            $shoppingCart = [];
            $totalItems = 0;
            $grandTotal = 0;

            foreach ($item->shoppingCart as $shoppingCartItem) {
                $product = [];

                $product['id'] = $shoppingCartItem->product->id;
                $product['image'] = $shoppingCartItem->product->image;
                $product['name'] = $shoppingCartItem->product->name;
                $product['description'] = $shoppingCartItem->product->description;
                $product['quantity'] = $shoppingCartItem->quantity;
                $product['price'] = $shoppingCartItem->product->price;
                $product['subTotal'] = $shoppingCartItem->quantity * $shoppingCartItem->product->price;

                $totalItems = $totalItems + $shoppingCartItem->quantity;
                $grandTotal = $grandTotal + ($shoppingCartItem->quantity * $shoppingCartItem->product->price);

                json_encode($product);

                $shoppingCart[] = collect($product);
                //$shoppingCart[] = (object) $product;
            }

            $newItem['totalItems'] = $totalItems;
            $newItem['grandTotal'] = $grandTotal;
            $newItem['shoppingCart'] = $shoppingCart;

            json_encode($newItem);

            return collect($newItem);
            //return (object) $newItem;
        });*/
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
