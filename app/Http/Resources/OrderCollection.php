<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        $orders = [];

        foreach ($this->collection as $order) {
            $orderItem = [];
            $orderItem['id'] = $order->id;
            $orderItem['user_id'] = $order->user_id;
            $orderItem['status'] = $order->status;
            $orderItem['created_at'] = new Carbon($order->created_at);
            $orderItem['updated_at'] = new Carbon($order->updated_at);

            /*if (! empty($order->deleted_at)) {
                $orders['deleted_at'] = $order->deleted_at->toDateTimeString();
            }

            $orderProducts = [];
            $totalItems = 0;
            $grandTotal = 0;

            foreach ($order->orderProduct as $orderProduct) {
                $product = [];

                $product['id'] = $orderProduct->product->id;
                $product['image'] = $orderProduct->product->image;
                $product['name'] = $orderProduct->product->name;
                $product['description'] = $orderProduct->product->description;
                $product['quantity'] = $orderProduct->quantity;
                $product['price'] = $orderProduct->product->price;
                $product['subTotal'] = $orderProduct->quantity * $orderProduct->product->price;

                $totalItems = $totalItems + $orderProduct->quantity;
                $grandTotal = $grandTotal + ($orderProduct->quantity * $orderProduct->product->price);

                $orderProducts[] = $product;
            }

            $orders['totalItems'] = $totalItems;
            $orders['grandTotal'] = $grandTotal;
            $orders['orderProduct'] = $orderProducts;*/

            $orders[] = collect($orderItem);
        }

        return [
            'data' => collect($orders)
        ];
    }
}
