<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    /**
     * Shopping carts table.
     *
     * @var string
     */
    protected $table = 'shopping_carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'quantity'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The shopping cart has many products.
     *
     * @return json object array
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The shopping cart has many users.
     *
     * @return json object array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
