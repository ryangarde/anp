<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShoppingCartCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $totalItems = null;
        $grandTotal = null;
        $items = [];

        foreach ($this->collection as $item) {
            $product = [];

            $product['id'] = $item->product->id;
            $product['image'] = $item->product->image;
            $product['name'] = $item->product->name;
            $product['description'] = $item->product->description;
            $product['quantity'] = $item->quantity;
            $product['price'] = $item->product->price;
            $product['subTotal'] = $item->quantity * $item->product->price;

            $totalItems = $totalItems + $item->quantity;
            $grandTotal = $grandTotal + ($item->quantity * $item->product->price);

            json_encode($product);

            $items[] = (object) $product;
        }

        return [
            'total_items' => $totalItems,
            'grand_total' => $grandTotal,
            'items' => $items
        ];
    }
}
