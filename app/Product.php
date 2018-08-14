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
        'producer_id', 'category_id', 'image', 'name', 'description', 'price','retail_size'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Run functions on boot.
     *
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            static::storeImage($model);
        });

        static::updating(function ($model) {
            static::updateImage($model);
        });

        static::deleting(function ($model) {
            static::deleteImage($model);
        });
    }

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
}
