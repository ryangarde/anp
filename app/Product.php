<?php

namespace App;

use App\Traits\FilterOtherModels;
use App\Traits\Filtering;
use App\Traits\Imaging;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Filtering, FilterOtherModels, Imaging, SoftDeletes;

    /**
     * Products table.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'producer_id', 'category_id', 'name', 'description'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];



    /**
     * The product belongs to a category.
     *
     * @return object
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The product belongs to a producer.
     *
     * @return object
     */
    public function producer()
    {
        return $this->belongsTo(Producer::class);
    }

    /**
     * The product belongs to many shopping carts.
     *
     * @return array object
     */
    public function shoppingCart()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function retailSizes()
    {
        return $this->belongsToMany(RetailSize::class);
    }

    public function productRetailSizes()
    {
        return $this->hasMany(ProductRetailSize::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
