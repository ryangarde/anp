<?php

namespace App;

use App\Traits\Filtering;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producer extends Model
{
    use Filtering, SoftDeletes;

    /**
     * Producers table
     *
     * @var string
     */
    protected $table = 'producers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'website'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The producer has many admins
     *
     * @return array object
     */
    public function admins()
    {
        $this->hasMany(Admin::class);
    }
}
