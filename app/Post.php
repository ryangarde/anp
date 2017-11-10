<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Filtering, SoftDeletes;

    /**
     * Post table.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id', 'slug', 'title', 'body'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The post belongs to an admin.
     *
     * @return object
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
