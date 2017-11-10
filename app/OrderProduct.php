<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use SoftDeletes;

    /**
     * Order product table.
     *
     * @var string
     */
    protected $table = 'order_product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The order product belongs to an order.
     *
     * @return object
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * The order product belongs to a product.
     *
     * @return object
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
