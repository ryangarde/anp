<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingCart extends Model
{
    use SoftDeletes;

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
     * Eager load relationships
     *
     * @var array
     */
    protected $with = [
        'product'
    ];

    /**
     * Run functions on boot.
     *
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });

        static::updating(function ($model) {
        });

        static::deleting(function ($model) {
        });
    }

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
