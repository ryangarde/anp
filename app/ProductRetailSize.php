<?php

namespace App;

use App\Traits\Filtering;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductRetailSize extends Model
{
    use Filtering, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'retail_size_id', 'price'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The category has many products.
     *
     * @return array object
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The category has many retail sizes.
     *
     * @return array object
     */
    public function retailSize()
    {
        return $this->belongsTo(RetailSize::class);
    }
}
