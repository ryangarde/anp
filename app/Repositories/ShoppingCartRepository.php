<?php

namespace App\Repositories;

use App\ShoppingCart;
use App\Contracts\ShoppingCartInterface;
use App\RetailSize;

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
     * Add quantity if item exists.
     *
     * @return boolean
     */
    public function storeIfItemExists($request)
    {
        if(ShoppingCart::where('product_id',$request->product_id)->where('retail_size_id',$request->retail_size_id)->exists()){
            $shoppingCart = ShoppingCart::where('product_id',$request->product_id)
                                        ->where('retail_size_id',$request->retail_size_id)
                                        ->first();
            $quantity = $request->quantity;
            $shoppingCart->quantity = $quantity + $shoppingCart->quantity;
            $shoppingCart->save();
        }
        else {
            $this->shoppingCart->create($request->all())->where('product_id',$request->product_id);
        }

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
                'product' => function ($query1) {
                    $query1->with('producer', 'category','productRetailSizes','images');
                }
            ])
            ->where('user_id', auth()->user()->id)
            ->get()
            ->map(function ($item) {
                return [

                    'id'             => $item->product->id,
                    'producer'       => $item->product->producer->name,
                    // 'category'       => $item->product->category->name,
                    'image'          => $item->product->images->first()->image,
                    'name'           => $item->product->name,
                    'description'    => $item->product->description,
                    'quantity'       => $item->quantity,
                    'price'          => $item->product->productRetailSizes->where('retail_size_id',$item->retail_size_id)->first()->price,
                    'retail_size'    => $item->retailSize->name,
                    'retail_size_id'    => $item->retail_size_id,
                    'sub_total'      => ($item->quantity * $item->product->productRetailSizes->where('retail_size_id',$item->retail_size_id)->first()->price)
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
