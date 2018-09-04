<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * Orders table.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'status','total','total_returned','shipment','discount','admin_id','receipt','receipt_date'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The order has many order products.
     *
     * @return array object
     */
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * The order belongs to a user.
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The order belongs to an admin.
     *
     * @return object
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
