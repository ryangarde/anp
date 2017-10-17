<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    
    /**
     * Roles table.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    /**
     * The roles has many admins.
     *
     * @return array object
     */
    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }

    /**
     * The role has many permissions.
     *
     * @return array object
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
