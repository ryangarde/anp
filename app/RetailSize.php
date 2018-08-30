<?php

namespace App;

use App\Traits\Filtering;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RetailSize extends Model
{
    use Filtering, SoftDeletes;

    /**
     * Retail Sizes table.
     *
     * @var string
     */
    protected $table = 'retail_sizes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The retail size belongs to many products.
     *
     * @return array object
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function productRetailSizes()
    {
        return $this->hasMany(ProductRetailSize::class);
    }

    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
