<?php

namespace App;

use App\Traits\FilterOtherModels;
use App\Traits\Filtering;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Imaging;

class Image extends Model
{
    use Filtering, SoftDeletes, Imaging, FilterOtherModels;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'product_id'
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
     * The image belongs to a product.
     *
     * @return array object
     */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
